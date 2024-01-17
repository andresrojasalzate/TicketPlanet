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
      $provincia =  $request->input('provincia');
      $ciudad = $request->input('ciudad');
      $codigoPostal = $request->input('codigoPostal');

      if ($request->hasCookie('direcciones')) {


        Log::info("se ha encotrado la cookie");

        return json_decode($request->cookie('direcciones'), true);

        //return response('Hello World')->withCookie(Cookie::forget('direccion'));

      } else {

        $direcciones = [
          'nombreLocal' => [$nombreLocal],
          'provincia' => [$provincia],
          'ciudad' => [$ciudad],
          'codigoPostal' => [$codigoPostal],
      ];

        //return  $direcciones;
        Log::info("Se crea la cookie"); 
        return response('dddd')->withCookie(Cookie::forever('direcciones', json_encode($direcciones)));

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