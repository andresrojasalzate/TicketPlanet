<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ShowEventController extends Controller
{
    public function mostrarEvento($id)
    {
        $evento = Event::findOrFail($id);

        return view('events.showEvents', compact('evento'));
    }
}
