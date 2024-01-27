<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Procesa la búsqueda de eventos según los parámetros proporcionados en la solicitud.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP recibida.
     * @return \Illuminate\View\View La vista que muestra los resultados de la búsqueda de eventos.
     */
    public function search(Request $request){
       
        Log::info("Asignamos los inputs 'busqueda' y 'category' a variables");
        $busqueda = $request->input('busqueda');
        $categoria =  $request->input('category');

        Log::info("Guardamos los valores de 'busqueda' y 'category'");
        session(['busqueda' => $busqueda]);
        session(['category' => $categoria]);

        Log::info("Devolvemos la vista con los eventos encontrados y las categorias");
        return view('events.index')->with([
        'events' => Event::eventosBuscados($busqueda, $categoria),
        'categories' => Category::all()
       ]);
    }

    /**
     * Maneja la búsqueda de eventos utilizando los parámetros almacenados en la sesión.
     * 
     *
     * @return \Illuminate\View\View La vista que muestra los resultados de la búsqueda de eventos.
     */
    public function searchGet(){

        Log::info("Recuperamos de sesion 'busqueda' y 'category'");
        $busqueda = session('busqueda');
        $categoria = session('category');

        Log::info("Devolvemos la vista con los eventos encontrados y las categorias");
        return view('events.index')->with([
        'events' => Event::eventosBuscados($busqueda, $categoria),
        'categories' => Category::all()
       ]);
    }


    /**
     * Maneja la solicitud para filtrar eventos por categoría.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function category(Request $request){

        Log::info("Asignamos los inputs 'category' a variables");
        $categoria = $request->input('category');
        
        Log::info("Guardamos los valores de 'busqueda' y 'category'");
        session(['categoria' => $categoria]);
        
        Log::info("Devolvemos la vista con los eventos encontrados y las categorias");
        return view('events.index')->with([
            'events' => Event::where('category_id', $categoria)->with('sessions')->paginate(env('PAGINATION_LIMIT')),
            'categories' => Category::all()
        ]);
    }

    /**
     * Maneja la solicitud GET para mostrar eventos filtrados por categoría.
     *
     * @return \Illuminate\View\View
     */
    public function categoryGet(){

        Log::info("Recuperamos de sesion 'categoria'");
        $categoria = session('categoria');
        
        Log::info("Devolvemos la vista con los eventos encontrados y las categorias");
        return view('events.index')->with([
            'events' => Event::where('category_id', $categoria)->with('sessions')->paginate(env('PAGINATION_LIMIT')),
            'categories' => Category::all()
        ]);
    }

    
}
