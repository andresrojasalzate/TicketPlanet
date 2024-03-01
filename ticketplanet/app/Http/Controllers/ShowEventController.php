<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Session;
use App\Models\Ticket;

class ShowEventController extends Controller
{
    public function mostrarEvento($id)
    {
        $evento = Event::findOrFail($id);
        $valoraciones = $evento->valoraciones;
        // $tickets = $evento->tickets;
        $tickets = $evento->tickets()->with('session')->get();
        $eventoId = $evento->id;

        return view('events.showEvents', compact('evento', 'valoraciones', 'tickets', 'eventoId'));
    }

}
