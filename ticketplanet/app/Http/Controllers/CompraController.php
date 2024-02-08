<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Compra;
use App\Models\Ticket;
use App\Models\Session;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CompraController extends Controller
{
    public function generarPdfEntradas()
    {

        $qr = QrCode::size(100)
            ->format('png')
            ->generate('https://laravel.com');

        //return view('pdfs.entrada', ['qr' => $qr]);
        $pdf = Pdf::loadView('pdfs.entrada', ['qr' => $qr]);
        return $pdf->stream();
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

        // Crear un array para almacenar la cantidad de entradas por tipo de ticket
        $cantidadPorTicket = [];


        // Recorrer los tickets y actualizar la cantidad de entradas vendidas
        foreach ($tickets as $ticket) {
            // Verificar si hay una cantidad específica de entradas vendidas para este ticket
            if (isset($cantidadEntradas[$ticket->id])) {
                // Almacenar la cantidad de entradas vendidas para este ticket
                $cantidadPorTicket[$ticket->id] = $cantidadEntradas[$ticket->id];
            } else {
                // Si no se proporciona una cantidad específica para este ticket, establecerlo en 0
                $cantidadPorTicket[$ticket->id] = 0;
            }
        }

        return view('compra.compra', compact('evento', 'sesionId', 'selectedDate', 'selectedTime', 'tickets', 'cantidadEntradas', 'totalPrice'));
    }

    public function almacenarCompra(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_name.*' => 'required|string',
            'dni.*' => 'required|string',
            'phone.*' => 'required|integer',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'user_name.*.required' => 'El campo nombre es obligatorio.',
            'user_name.*.string' => 'Por favor, introduce un nombre válido.',
            'dni.*.required' => 'El campo DNI es obligatorio.',
            'dni.*.string' => 'Por favor, introduce un DNI válido.',
            'phone.*.required' => 'El campo teléfono es obligatorio.',
            'phone.*.integer' => 'Por favor, introduce un teléfono válido.',
        ]);
    
        $selectedDate = $request->input('selected_date');
        $selectedTime = $request->input('selected_time');
        $sessionId = $request->input('session_id');
        $ticketId = $request->input('ticket_id');
    
        foreach ($request->user_name as $key => $userName) {
            $email = $request->email;
            $date = $request->selected_date;
            $time = $request->selected_time;
        
            $userName = isset($request->user_name[$key]) ? $request->user_name[$key] : null;
            $ticketName = isset($request->ticket_name[$key]) ? $request->ticket_name[$key] : null;
            $ticketQuantity = isset($request->ticket_quantity[$key]) ? $request->ticket_quantity[$key] : null;
            $ticketId = isset($request->ticket_id[$key]) ? $request->ticket_id[$key] : null;
        
            if ($ticketName !== null) {
                Compra::create([
                    'email' => $email,
                    'date' => $date,
                    'time' => $time,
                    'ticket_name' => $ticketName,
                    'ticket_quantity' => $ticketQuantity,
                    'session_id' => $sessionId,
                    'ticket_id' => $ticketId,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Compra almacenada correctamente.');
    }
}
