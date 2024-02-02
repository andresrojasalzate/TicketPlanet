<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function mostrarCompra(Request $request)
    {
        
        return view('compra.compra'); 
    }
}
