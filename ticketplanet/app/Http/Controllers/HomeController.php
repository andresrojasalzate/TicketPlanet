<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function home(){
        
        Log::info("Mensaje de prueba");
        return view('events.home', ['categories'=> Category::recuperarCategoriasHome()]);
       
       
    }
}
