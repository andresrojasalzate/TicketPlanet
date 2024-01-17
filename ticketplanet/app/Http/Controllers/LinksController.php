<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class LinksController extends Controller
{
    public function home()
    {
        return view('links.home');
    }

    public function aboutUs()
    {
        return view('links.aboutus');
    }

    public function legalNotice()
    {
        return view('links.legalnotice');
    }
    public function crearEvento()
    {
      return view('links.crearEvento');
    }

    public function guardarEvento(Request $request)
    {
      $nombreLocal = $request->input('nombreLocal');

      if ($request->hasCookie('direccion')) {


        Log::info("se ha encotrado la cookie");

        return "cookie existe";

      } else {

        $response = new Response("Cookie no existe");
        $response->withCookie(Cookie::forever('direccion', $nombreLocal));
        Log::info("Se crea la cookie"); 
        return $response;

      }

    }

    public function comprarEntradas()
    {
      return view('links.comprarEntradas');
    }
    public function homePromotors()
    {
      if(Auth()->user()){
        return view('links.homePromotors');
      }
        return redirect()->route('auth.login');
      
           
    }
}