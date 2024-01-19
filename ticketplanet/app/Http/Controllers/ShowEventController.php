<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Session;

class ShowEventController extends Controller
{
    public function mostrarEvento($id)
    {
        $evento = Event::findOrFail($id);

        return view('events.showEvents', compact('evento'));
    }

    public function sesiones()
    {
        return $this->hasMany(Session::class);
    }
}
