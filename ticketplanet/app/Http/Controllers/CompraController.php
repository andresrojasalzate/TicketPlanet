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
use Illuminate\Support\Facades\File;

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
                Log::info("Session para guardar la cantidad de entradas con su id");
                $cantidadTicket = session('cantidadEntradasSesion');
                
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
    public function datosRedsys(Request $request){

      $this->almacenarCompra($request);

      $totalPrice = $request->totalPrice;
     

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

        $formulario = '<form id="form" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">';
        $formulario .= '<input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1">';
        $formulario .= '<input type="hidden" name="Ds_MerchantParameters" value="' . htmlspecialchars($params) . '">';
        $formulario .= '<input type="hidden" name="Ds_Signature" value="' . htmlspecialchars($signature) . '">';
        $formulario .= '</form>';
    
        $formulario .= '<script type="text/javascript">';
        $formulario .= 'document.getElementById("form").submit();';
        $formulario .= '</script>';
    
        return $formulario;
    }

    public function paginaRedsys(Request $request){

        $cantidadTicket = session('cantidadEntradasSesion');

    foreach ($cantidadTicket as $id => $ticketsVendidos) {
      // dd($id);
      $ticket = Ticket::find($id);
      if ($ticket->price == 0) {
        Log::info("El precio de la entrada es 0 y la guarda");
        $ticket->update([
          'sold_tickets' => $ticket->sold_tickets + $ticketsVendidos,
      ]);
      }
    }

    return redirect()->route('compra.compraExito');

      
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
        Log::info("Passa correctamente la pasarela de pago");
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
        return redirect()->route('compra.compraFallido');
      }
    }
    public function entradaCompradaView()
    {
      
      $idCompra = arrayEntradaTicket::get('idCompra');
      $compra = Compra::find($idCompra);
      $this->enviarMailCompra($compra);

      Log::info("Vista pagina compra exito");
      return view('compra.compraExito');
      
    }
    public function entradaCompradaViewFallido()
    {
      $idCompra = arrayEntradaTicket::get('idCompra');
      $this->eliminarCompra($idCompra);
      Log::info("Vista pagina compra fallida");
      return view('compra.compraFallido');
    }

    private function eliminarCompra($idCompra)
    {
        $compra = Compra::find($idCompra);
        File::delete(storage_path('app/pdfs/') . $compra->pdfTickets);
        $compra->delete();

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

        arrayEntradaTicket::forget('idCompra');

        arrayEntradaTicket::put('idCompra', $compra->id);

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
