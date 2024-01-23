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
use Illuminate\Support\Facades\Storage;

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

      }else{
        return redirect()->route('auth.login');
      }

      return view('links.crearEvento')->with([
        'categorias' => Category::all(),
        'addresses' =>  Event::select(['address'])->where('user_id', $user->id)->get(),
        'citys' =>  Event::select(['city'])->where('user_id', $user->id)->get(),
        'nameSites' =>  Event::select(['name_site'])->where('user_id', $user->id)->get(),
        'capacitys' => Event::select(['capacity'])->where('user_id', $user->id)->get()
      ]);
     
    }

    public function comprarEntradas()
    {
      return view('links.comprarEntradas');
    }
    public function storeComprarEntradas(Request $request)
    {

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
      
      $request->validate([
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'name_site' => 'required',
        'image' => 'required',
        'description' => 'required',
        'finishDate' => 'required',
        'finishTime' => 'required',
        'visible' => 'required',
        'capacity' => 'required|min:1'
      ]);                           

      $foto = $request->file('image');
      $nombre_foto = $foto->getClientOriginalName();
      $extension = $foto->getClientOriginalExtension();
      $nombre_unico = $nombre_foto . '_' . time() . '.' . $extension;
      $foto->move(public_path('images/fotos-subidas/'), $nombre_unico);

      $eventoCrear = Event::create([
        'name' => $request->name,
        'address' => $request->address,
        'city' => $request->city,
        'name_site' => $request->name_site,
        'site' => $request->site,
        'image' => $nombre_unico,
        'description' => $request->description,
        'finishDate' => $request->finishDate,
        'finishTime' => $request->finishTime,
        'visible' => $request->visible,
        'capacity' => $request->capacity,
        'category_id' => $request->categoria,
        'user_id' => $user->id,
      ]);

      return $eventoCrear->id;
    }

    private function crearSesion(Request $request, $eventId){

      $request->validate([
        'date' => 'required',
        'time' => 'required',
        'maxCapacity' => 'required|lte:capacity'
      ]);

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