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
        $tickets = $evento->tickets;
        $eventoId = $evento->id;

        return view('events.showEvents', compact('evento', 'tickets', 'eventoId'));
    }

    // public function sesiones()
    // {
    //     return $this->hasMany(Session::class);
    // }
}
