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

    } else {
      return redirect()->route('auth.login');
    }

    return view('links.crearEvento')->with([
      'categorias' => Category::all(),
      'addresses' => Event::select(['address'])->where('user_id', $user->id)->get(),
      'citys' => Event::select(['city'])->where('user_id', $user->id)->get(),
      'nameSites' => Event::select(['name_site'])->where('user_id', $user->id)->get(),
      'capacitys' => Event::select(['capacity'])->where('user_id', $user->id)->get()
    ]);

  }

  public function comprarEntradas(Request $request)
  {
    $sesion = Session::find($request->session()->get('sesionId'));

    
    if ($request->session()->has('capacidadMaxima')) {
      $capacidadMaxima = $request->session()->get('capacidadMaxima');
    }else{
      session(['capacidadMaxima' => $sesion->maxCapacity]);
      $capacidadMaxima = $sesion->maxCapacity;
      
    }
    
    return view('links.comprarEntradas')->with('entradasRestantes', $capacidadMaxima);
  }
  public function storeComprarEntradas(Request $request)
  {

    if (empty($request->quantity)) {
      Log::info("Cantidad Entradas vacio");
      $request->validate([
        'name' => 'required',
        'price' =>  'required',
        'nominal' => 'required',
      ]);
      $capacidadMaxima = session('capacidadMaxima');
  
      $quantity = $capacidadMaxima; 
    } else {
      $quantity = $request->quantity;
    }
    
    $cantidadEntradas = $request->quantity;

    $capacidadMaxima = session('capacidadMaxima');

    Log::info("Validacion campos");
    $request->validate([
      'name' => 'required',
      'price' =>  'required',
      'nominal' => 'required',
    ]);

 
      if ($cantidadEntradas > $capacidadMaxima) {
        Log::info("Cantidad entradas es mayor que la capacidad maxima");
        $request->validate([
          'name' => 'required',
          'quantity' => 'lte:capacidadMaxima',
          'price' =>  'required',
          'nominal' => 'required',
        ]); 
    }
    

    if (session('capacidadMaxima') == 0) {
      Log::info("Redirecciona al home cuando la capacidad maxima es 0");
      return redirect()->route('home');
    }
  
    Ticket::create([
      'name' => $request->name,
      'quantity' => $quantity,
      'price' => $request->price,
      'nominal' => $request->nominal,
      'session_id' => $request->session()->get('sesionId')
    ]);
    $entradasRestantes = session('capacidadMaxima') - $cantidadEntradas;
    session(['capacidadMaxima' => $entradasRestantes]);

    return redirect()->route('links.comprarEntradas');
  }

  public function store(Request $request)
  {

    if (Auth::check()) {
      Log::info("Store");
      $idEvento = $this->guardarEvento($request);
      $this->crearSesion($request, $idEvento);

      return redirect()->route('links.comprarEntradas');
    }
  }

  private function guardarEvento(Request $request)
  {

    $user = Auth::user();
    Log::info("Guardar evento");

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

  private function crearSesion(Request $request, $eventId)
  {

    Log::info("Crear Sesion");

    $request->validate([
      'date' => 'required',
      'time' => 'required',
      'maxCapacity' => 'required|lte:capacity'
    ]);

    $sesionCreada = Session::create([
      'date' => $request->date,
      'time' => $request->time,
      'maxCapacity' => $request->maxCapacity,
      'event_id' => $eventId,
      'ticketsSold' => 0
    ]);

    $request->session()->put('sesionId', $sesionCreada->id);
  }
  public function administrarEvents()
  {
    if (Auth()->user()) {
      // Obtener los eventos del promotor
      $events = Event::where('user_id', Auth()->user()->id)->with('sessions')->paginate(env('PAGINATION_LIMIT'));

      // Pasar los eventos a la vista
      return view('links.administrarEvents', ['events' => $events]);
    }

    return redirect()->route('auth.login');
  }

  public function administrarEvento()
  {
    if (Auth()->user()) {
      // Obtener los eventos del promotor
      $events = Event::where('user_id', Auth()->user()->id)->with('sessions')->paginate(env('PAGINATION_LIMIT'));

      // Pasar los eventos a la vista
      return view('links.administrarEvents', ['events' => $events]);
    }

    return redirect()->route('auth.login');
  }

  public function homePromotors()
    {
      if(Auth()->user()){
        return view('links.homePromotors');
      }
        return redirect()->route('auth.login');
      
           
    }

    public function sessionEvents()
    {
      if (Auth()->user()) {
        // Obtener los eventos del promotor
        $events = Event::where('user_id', Auth()->user()->id)->with('sessions')->paginate(env('PAGINATION_LIMIT'));
  
        // Pasar los eventos a la vista
        return view('links.sessionEvents', ['events' => $events]);
      }
  
      return redirect()->route('auth.login');
    }
    public function crearMultiplesSesiones($Id)
    {
      if (Auth::check()) {

        $user = Auth::user();
  
      } else {
        return redirect()->route('auth.login');
      }
      
      $event = Event::find($Id);
      $sessions = Session::find($Id);


return view('links.crearMultiplesSesiones',compact('event', 'sessions'))->with([
    'event' => $event,
    'sessions' => $sessions
]);

    }

}