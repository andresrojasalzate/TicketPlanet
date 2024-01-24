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

        session(['busqueda' => $busqueda]);
        session(['category' => $categoria]);

        return view('events.index')->with([
        'events' => Event::eventosBuscados($busqueda, $categoria),
        'categories' => Category::all()
       ]);
    }

    public function searchGet(){
       
        $busqueda = session('busqueda');
        $categoria = session('category');

        return view('events.index')->with([
        'events' => Event::eventosBuscados($busqueda, $categoria),
        'categories' => Category::all()
       ]);
    }

    public function category(Request $request){
        $categoria = $request->input('category');
    
        session(['categoria' => $categoria]);
        
        return view('events.index')->with([
            'events' => Event::where('category_id', $categoria)->with('sessions')->paginate(env('PAGINATION_LIMIT')),
            'categories' => Category::all()
        ]);
    }

    public function categoryGet(){
        $categoria = session('categoria');
        
        return view('events.index')->with([
            'events' => Event::where('category_id', $categoria)->with('sessions')->paginate(env('PAGINATION_LIMIT')),
            'categories' => Category::all()
        ]);
    }

    
}
