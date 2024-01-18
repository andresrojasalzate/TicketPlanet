<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Session;
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
      return view('links.crearEvento',["categorias" => Category::all()]);

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
    public function storeComprarEntradas(Request $request)
    {
      Ticket::create([
        'name' => $request->name,
        'quantity' => $request->quantity,
        'price' => $request->price,
        'nominal' => $request->nominal

      ]);
      
    }
    
    public function store(Request $request)
    {
      $eventoCrear=Event::create([
        'name' => $request->name,
        'address' => $request->address,
        'city' => $request->city,
        'name_site' => $request->name_site,
        'site' => $request->site,
        'image' => $request->image,
        'description' => $request->description,
        'finishDate' => $request->finishDate,
        'finishTime' => $request->finishTime,
        'visible' => $request->visible,
        'capacity' => $request->capacity,
        'category_id' => $request->categoria
      ]);

      // Category::create([
      //   'category' => $request->category
      // ]);

      Session::create([
        'date' => $request->date,
        'time' => $request->time,
        'maxCapacity' => $request->maxCapacity,
        'event_id' => $eventoCrear->id
      ]);
      
      return redirect()->route('home');
    }
    public function homePromotors()
    {
      if(Auth()->user()){
        return view('links.homePromotors');
      }
        return redirect()->route('auth.login');
      
           
    }
}