<?php


namespace App\Http\Controllers;
require_once base_path('app/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php');

use App\Models\Event;
use App\Models\Compra;
use App\Models\Ticket;
use App\Models\Session;
use App\Models\Assistant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as arrayEntradaTicket;
use App\Mail\VentaMail;

class CompraController extends Controller
{
    public function generarPdfEntradas($compraId)
    {

        $compra = Compra::find($compraId);

        $qr = QrCode::size(100)
            ->format('png')
            ->generate('https://laravel.com');

        $pdf = Pdf::loadView('pdfs.entrada', ['qr' => $qr, 'compra' => $compra]);
        $pdf->render();
        $contenidoPdf = $pdf->output();
        $namePdf = uniqid(). '.pdf';
        Storage::disk('pdfs')->put($namePdf, $contenidoPdf);
        $compra->pdfTickets = $namePdf;
        $compra->save();
        return  $compra;
    }

    public function mostrarCompra(Request $request)
    {
        $evento = Event::findOrFail($request->evento_id);
        $sesionId = $request->input('sesion');
        $session = Session::find($sesionId);
        $selectedDate = $session->date;
        $selectedTime = $session->time;

        $tickets = $evento->tickets;
        $totalPrice = $request->total_price;


        // Obtener la cantidad de entradas seleccionadas del formulario
        $cantidadEntradas = $request->input('sold_tickets');


        // Verificar si la suma de las entradas vendidas es cero
        $totalEntradas = array_sum($cantidadEntradas);
        if ($totalEntradas === 0) {
            return redirect()->back()->with('error', 'Por favor, selecciona al menos una entrada antes de proceder con la compra.');
        }

        // Crear un array para almacenar la cantidad de entradas por tipo de ticket
        $cantidadPorTicket = [];
        

        $hayNoNominal = false;

        // Recorrer los tickets y actualizar la cantidad de entradas vendidas
        foreach ($tickets as $ticket) {
            // Verificar si hay una cantidad específica de entradas vendidas para este ticket
            if (isset($cantidadEntradas[$ticket->id])) {
                // Almacenar la cantidad de entradas vendidas para este ticket
                $cantidadPorTicket[$ticket->id] = $cantidadEntradas[$ticket->id];
                arrayEntradaTicket::put('cantidadEntradasSesion', $cantidadPorTicket);
                if(!$ticket->nominal){
                    $hayNoNominal = true;
                }
            } else {
                // Si no se proporciona una cantidad específica para este ticket, establecerlo en 0
                $cantidadPorTicket[$ticket->id] = 0;
            }
        }
        $precioTotal = $request->input("totalPrice");

    $amount = (int)$totalPrice * 100;
    $id = time();
    $fuc = '999008881';
    $moneda = '978';
    $trans = '0';
    $terminal = '001';
    $url = '';
    $urlOK = route('entradaComprada');
    $urlKO = route('entradaCompradaViewFallido');

    $miObj = new \RedsysAPI;
    $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
    $miObj->setParameter("DS_MERCHANT_ORDER", $id);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
    $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
    $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
    $miObj->setParameter("DS_MERCHANT_DIRECTPAYMENT", "true");
    $miObj->setParameter("DS_REDSYS_ENVIROMENT", "true");
    $miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
    $miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);  

    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature('sq7HjrUOBfKmC576ILgskD5srU870gJ7');



        return view('compra.compra', compact('evento', 'sesionId', 'selectedDate', 'selectedTime', 'tickets', 'cantidadEntradas', 'totalPrice','params','signature', 'hayNoNominal'));
    }
    public function entradaComprada(Request $request)
    {

      $miObj = new \RedsysAPI;
      $params = json_decode(base64_decode($request->input("Ds_MerchantParameters")));
      $version = $request->input("Ds_SignatureVersion");
      $signaturaRecibida = $request->input("Ds_Signature");
      $datos = $request->input("Ds_MerchantParameters");
      $decodec = $miObj->decodeMerchantParameters($datos);
      $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
      $signaturaCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $datos);
  
      if ($signaturaCalculada == $signaturaRecibida) {

        $arrayFromSession = session('cantidadEntradasSesion');
        foreach($arrayFromSession as $id => $soldTicket){
          $ticket = Ticket::find($id);
            $ticket->update([
              'sold_tickets' => $ticket->sold_tickets + $soldTicket,
          ]);
        }

       arrayEntradaTicket::forget('cantidadEntradasSesion');
        return redirect()->route('compra.compraExito');
      } else {
        echo "FIRMA KO.Error, firma inválida";
      }
    }
    public function entradaCompradaView()
    {
      return view('compra.compraExito');
      
    }
    public function entradaCompradaViewFallido()
    {
      return view('compra.compraFallido');
    }

    public function almacenarCompra(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_name.*' => 'required|string',
            'dni.*' => ['required', 'string', 'regex:/^[0-9]{8}[A-Za-z]$/'],
            'phone.*' => ['required', 'integer', 'regex:/^[0-9]{9}$/'],
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'user_name.*.required' => 'El campo nombre es obligatorio.',
            'user_name.*.string' => 'Por favor, introduce un nombre válido.',
            'dni.*.required' => 'El campo DNI es obligatorio.',
            'dni.*.string' => 'Por favor, introduce un DNI válido.',
            'dni.*.regex' => 'El formato del DNI no es válido.',
            'phone.*.required' => 'El campo teléfono es obligatorio.',
            'phone.*.integer' => 'Por favor, introduce un teléfono válido.',
            'phone.*.regex' => 'El formato del teléfono no es válido.',
        ]);

        $compraId = $this->crearCompra($request);
        $this->crearAsistentes($request, $compraId);
        $compra = $this->generarPdfEntradas($compraId);
        $this->enviarMailCompra($compra);


        // $selectedDate = $request->input('selected_date');
        // $selectedTime = $request->input('selected_time');
        // $sessionId = $request->input('session_id');
        // //$ticketId = $request->input('ticket_id');

       


        // foreach ($request->user_name as $key => $userName) {
        //     $email = $request->email;
        //     $date = $request->selected_date;
        //     $time = $request->selected_time;
        
        //     $userName = isset($request->user_name[$key]) ? $request->user_name[$key] : null;
        //     $ticketName = isset($request->ticket_name[$key]) ? $request->ticket_name[$key] : null;
        //     $ticketQuantity = isset($request->ticket_quantity[$key]) ? $request->ticket_quantity[$key] : null;
        //     $ticketId = isset($request->ticket_id[$key]) ? $request->ticket_id[$key] : null;

        //     if ($ticketName !== null) {
        //         Compra::create([
        //             'email' => $email,
        //             'date' => $date,
        //             'time' => $time,
        //             'ticket_name' => $ticketName,
        //             'ticket_quantity' => $ticketQuantity,
        //             'session_id' => $sessionId,
        //             'ticket_id' => $ticketId,
        //         ]);
        //     }
        // }

        //return redirect()->route('events.mostrar', ['id' => $request->evento_id])->with('success', 'Compra almacenada correctamente.');
        return redirect()->route('events.mostrar', $request->evento_id)->with('success', 'Compra almacenada correctamente.');

    }

    private function enviarMailCompra($compra)
    {
        Mail::to($compra->emailPurchaser)->send(new VentaMail($compra->id)); 
    }

    private function crearCompra(Request $request)
    {

        Log::info('email' . $request->email);
        $compra = Compra::create([
            'emailPurchaser' => $request->email,
            'namePurchaser' => $request->comprador_name,
            'dniPurchaser' => $request->comprador_dni,
            'phonePurchaser' => $request->comprador_phone,
            'session_id' => $request->session_id,
        ]);

        return $compra->id;
    }

    private function crearAsistentes(Request $request, $compradId)
    {   
        if(isset($request->user_name)){
            foreach ($request->user_name as $key => $userName) { 
                Assistant::create([
                    'nameAssistant' => $request->user_name[$key],
                    'dniAssistant' => $request->dni[$key],
                    'phoneAssistant' => $request->phone[$key],
                    'ticket_id' => $request->ticket_id[$key],
                    'compra_id' => $compradId,
                ]);

            }
        }

        if(isset($request->tickets_noNomial)){
            foreach ($request->tickets_noNomial as $key => $ticket) {
                Assistant::factory()->count($request->ticketNoNomial_quantity[$ticket])->create([
                    'ticket_id' => $request->tickets_noNomial[$key],
                    'compra_id' => $compradId, 
                ]);
            }
        }
    }    
}
