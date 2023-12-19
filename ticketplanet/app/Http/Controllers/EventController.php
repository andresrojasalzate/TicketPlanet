<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index() {
        return view('events.index', ['events' => Event::with('sessions')->get()]);
        //return  Event::eventosBuscados("c");

    }

    public function search(Request $request){

        $busqueda = $request->input('busqueda');

        return view('events.index', ['events' => Event::eventosBuscados($busqueda)]);
        
    }
}
