<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index() {
        //Controlamos la cantidad de eventos mostrados con el "take", máximo 5
        return view('events.index', ['events' => Event::with('sessions')->take(5)->get()]);
        //return Event::with('sessions')->get();

    }
}
