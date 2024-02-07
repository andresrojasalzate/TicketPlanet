<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        return view('compra.compra', compact('evento', 'selectedDate', 'selectedTime', 'tickets', 'cantidadEntradas', 'totalPrice'));
    }
}
