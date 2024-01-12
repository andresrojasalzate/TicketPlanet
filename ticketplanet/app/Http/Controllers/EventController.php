<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index(Request $request = null) {   
        return view('events.index', ['events' => Event::with('sessions')->paginate(env('PAGINATION_LIMIT'))]);
    }

    public function search(Request $request){

        $busqueda = $request->input('busqueda');
        $categoria =  $request->input('category');

       return view('events.index', ['events' => Event::eventosBuscados($busqueda, $categoria)]);
    }
    public function crearEvento()
    {
      return view('links.crearEvento');
    }

    public function category(Request $request){
        $categoria =  $request->input('category');
        return view('events.index', ['events' => Event::where('category_id', $categoria)->with('sessions')->paginate(env('PAGINATION_LIMIT'))]);
    }
}
