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
      if (Auth::check()) {
        $user = Auth::user();
      }

      //return Event::select(['name_site'])->where('user_id', $user->id)->get();

      return view('links.crearEvento')->with([
        'categorias' => Category::all(),
        'addresses' =>  Event::select(['address'])->where('user_id', $user->id)->get(),
        'citys' =>  Event::select(['city'])->where('user_id', $user->id)->get(),
        'nameSites' =>  Event::select(['name_site'])->where('user_id', $user->id)->get(),
        'capacitys' => Event::select(['capacity'])->where('user_id', $user->id)->get()
      ]);
     
    }

    /*public function guardarEvento(Request $request)
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

    }*/

    public function comprarEntradas()
    {
      return view('links.comprarEntradas');
    }
    public function storeComprarEntradas(Request $request)
    {
      $quantity;
      if(empty($request->quantity)){
        $sesion = Session::find($request->session()->get('sesionId'));
        $quantity = $sesion->maxCapacity;
      } else{
        $quantity = $request->quantity;
      }

      Ticket::create([
        'name' => $request->name,
        'quantity' => $quantity,
        'price' => $request->price,
        'nominal' => $request->nominal,
        'session_id' => $request->session()->get('sesionId')
      ]);

      return redirect()->route('links.comprarEntradas');
      
    }
    
    public function store(Request $request)
    {

      if (Auth::check()) {

        $idEvento = $this->guardarEvento($request);
        $this->crearSesion($request, $idEvento);
      
        return redirect()->route('links.comprarEntradas');
      }
    }

    private function guardarEvento(Request $request){

      $user = Auth::user();

      $eventoCrear = Event::create([
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
        'category_id' => $request->categoria,
        'user_id' => $user->id
      ]);

      return $eventoCrear->id;
    }

    private function crearSesion(Request $request, $eventId){

      $sesionCreada = Session::create([
        'date' => $request->date,
        'time' => $request->time,
        'maxCapacity' => $request->maxCapacity,
        'event_id' => $eventId
      ]);

      $request->session()->put('sesionId', $sesionCreada->id);
    }

    public function homePromotors()
    {
      if(Auth()->user()){
        return view('links.homePromotors');
      }
        return redirect()->route('auth.login');
      
           
    }
}