<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function home(){
        
        Log::info("Mensaje de prueba");
        return view('events.home', ['categories'=> Category::all()]);
       
       
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

        $categorias = Category::all();
        $nombreCategoriaFiltrada = $categorias->where('id', $categoria)->pluck(['name']);
        
        Log::info("Devolvemos la vista con los eventos encontrados y las categorias");
        return view('events.index')->with([
            'events' =>  Event::where('category_id', $categoria)->eventosVisibles()->paginate(env('PAGINATION_LIMIT')),
            'categories' => $categorias,
            'textoIntroducido'=> null,
            'categoriFiltrada' => $nombreCategoriaFiltrada[0] ?? null
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

        $categorias = Category::all();
        $nombreCategoriaFiltrada = $categorias->where('id', $categoria)->pluck(['name']);
        
        Log::info("Devolvemos la vista con los eventos encontrados y las categorias");
        return view('events.index')->with([
            'events' => Event::where('category_id', $categoria)->eventosVisibles()->paginate(env('PAGINATION_LIMIT')),
            'categories' => $categorias,
            'textoIntroducido'=> null,
            'categoriFiltrada' => $nombreCategoriaFiltrada[0] ?? null
        ]);
    }
}
