<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index() {   
        return view('events.index', ['events' => Event::with('sessions')->paginate(env('PAGINATION_LIMIT'))]);
    }

    public function search(Request $request){
       
        $busqueda = $request->input('busqueda');
        $categoria =  $request->input('category');
        
        if($busqueda !== null){
            $request->session()->put('busqueda', $busqueda);
            $request->session()->put('category', $categoria);
        }else if($request->session()->get('busqueda') !== null && $busqueda !== null){
            $categoria = $request->session()->get('category'); 
            $busqueda = $request->session()->get('busqueda'); 
        }

        return view('events.index')->with([
        'events' => Event::eventosBuscados($busqueda, $categoria),
        'categories' => Category::all()
       ]);
    }

    public function category(Request $request){
        $categoria = $request->input('category');
        if(isset($categoria)){
            $request->session()->put('categoria', $categoria);
        }else{
            $categoria = $request->session()->get('categoria'); 
        }

        return view('events.index')->with([
            'events' => Event::where('category_id', $categoria)->with('sessions')->paginate(env('PAGINATION_LIMIT')),
            'categories' => Category::all()
        ]);
    }
}
