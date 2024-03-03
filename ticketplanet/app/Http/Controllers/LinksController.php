<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session as ReinicarMaxCapacity;
use App\Models\Event;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Session;
use Illuminate\Support\Facades\Session as Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class LinksController extends Controller
{

  public function aboutUs()
  {
    return view('links.aboutus');
  }

  public function legalNotice()
  {
    return view('links.legalnotice');
  }
  public function crearEvento(Request $request)
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
    } else {
      Log::info("La capacidad maxima sera la capacidad");
      session(['capacidadMaxima' => $sesion->maxCapacity]);
      $capacidadMaxima = $sesion->maxCapacity;

    }
    if (session('capacidadMaxima') == 0) {
      Log::info("Redireccionando al home porque la capacidad máxima es 0");
      Feedback::flash('success', '¡Se ha creado el evento y la entrada correctamente!');
      return redirect()->route('links.homePromotors');
  }

    return view('links.comprarEntradas')->with('entradasRestantes', $capacidadMaxima);
  }
  public function storeComprarEntradas(Request $request)
  {

    if (empty($request->quantity)) {
      Log::info("Cantidad Entradas vacio y valida");
      $request->validate([
        'name' => 'required',
        'price' => 'required',
        'nominal' => 'required',
      ]);
      $capacidadMaxima = session('capacidadMaxima');

      $quantity = $capacidadMaxima;
    } else {
      $quantity = $request->quantity;
    }

    $cantidadEntradas = $request->quantity;

    $capacidadMaxima = session('capacidadMaxima');

    Log::info("Validacion campos entradas");
    $request->validate([
      'name' => 'required',
      'price' => 'required',
      'nominal' => 'required',
    ]);


    if ($cantidadEntradas > $capacidadMaxima) {
      Log::info("Cantidad entradas es mayor que la capacidad maxima");
      $request->validate([
        'name' => 'required',
        'quantity' => 'lte:capacidadMaxima',
        'price' => 'required',
        'nominal' => 'required',
      ]);
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

    Feedback::flash('success', '¡La entrada se ha creado correctamente!');

    return redirect()->route('links.comprarEntradas');
  }

  public function store(Request $request)
  {
    if (Auth::check()) {
      ReinicarMaxCapacity::forget('capacidadMaxima');
      Log::info("Store");
      $idEvento = $this->guardarEvento($request);
      $this->crearSesion($request, $idEvento);

      return redirect()->route('links.comprarEntradas');
    }
  }

  private function guardarEvento(Request $request)
  {

    $user = Auth::user();
    Log::info("Crea el evento a la base de datos");


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
      'capacity' => 'required',
      'date' => 'required',
      'time' => 'required',
      'maxCapacity' => 'required|lte:capacity'
    ]);

    // Guardar imágenes
    $imagenes = [];
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $imagen) {

          if(env('API_LOCAL')){
            Log::info("api local");
            $response = Http::withToken(env('API_KEY'))->attach(
              'image', $imagen->get(), $imagen->getClientOriginalName()
            )->post('http://127.0.0.1:9000/api/images/store');
          }else{
            Log::info("api server");
            $response = Http::withToken(env('API_KEY'))->attach(
              'image', $imagen->get(), $imagen->getClientOriginalName()
            )->post('http://127.0.0.1:8080/api/images/store');
          }      
          $data = $response->json();
          $imagenes[] = $response['imageId'];
        }
    }

    $eventoCrear = Event::create([
      'name' => $request->name,
      'address' => $request->address,
      'city' => $request->city,
      'name_site' => $request->name_site,
      'image' => json_encode($imagenes),
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
    $sesionCreada = Session::create([
      'date' => $request->date,
      'time' => $request->time,
      'maxCapacity' => $request->maxCapacity,
      'event_id' => $eventId,
      'ticketsSold' => 0,
      'open' => true
    ]);

    $request->session()->put('sesionId', $sesionCreada->id);
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
    if (Auth()->user()) {
      return view('links.homePromotors');
    }
    return redirect()->route('auth.login');


  }

  public function sessionEvents()
  {

    if (Auth()->user()) {

      $events = Event::where('user_id', Auth()->user()->id)->with('sessions')->paginate(env('PAGINATION_LIMIT'));


      return view('links.sessionEvents', ['events' => $events]);
    }

    return redirect()->route('auth.login');
  }
  public function multiplesSesiones($Id)
  {
    if (Auth::check()) {

      $user = Auth::user();

    } else {
      return redirect()->route('auth.login');
    }
    ReinicarMaxCapacity::forget('capacidadMaxima');

    $event = Event::find($Id);
    $sessions = Session::where('event_id', $Id)->first();

    return view('links.multiplesSesiones', compact('event','sessions'));

  }

  public function crearMultiplesSesiones(Request $request, $eventId)
  {
    $evento = Event::findOrFail($eventId);
    $capacity = $evento->capacity;

    $request->validate([
      'date' => 'required',
      'time' => 'required',
      'maxCapacity' => 'required|lte:' . $capacity,
    ]);

    $existingSessions = Session::where('event_id', $eventId)
    ->where('date', $request->date)
    ->where('time', $request->time)
    ->get();

if ($existingSessions->isNotEmpty()) {
    return redirect()->back()->with('error', 'No puede haber dos sesiones con las mismas fechas.');
}
    
    $crearSesion = Session::create([
      'date' => $request->date,
      'time' => $request->time,
      'maxCapacity' => $request->maxCapacity,
      'event_id' => $eventId,
      'ticketsSold' => 0
    ]);


    $request->session()->put('sesionId', $crearSesion->id);
    $request->session()->put('datosPrimerFormulario', $request->all());

    return redirect()->route('links.comprarEntradasSesion');
  }
  public function comprarEntradasSesion(Request $request)
  {

    $sesion = Session::find($request->session()->get('sesionId'));


    if ($request->session()->has('capacidadMaxima')) {
      $capacidadMaxima = $request->session()->get('capacidadMaxima');
    } else {
      session(['capacidadMaxima' => $sesion->maxCapacity]);
      $capacidadMaxima = $sesion->maxCapacity;
    }
    if (session('capacidadMaxima') == 0) {
      Feedback::flash('success', '¡Se ha creado la session con la entrada correctamente!');
      return redirect()->route('links.sessionEvents');
  }

    return view('links.comprarEntradasSesion')->with('entradasRestantes', $capacidadMaxima);
  }

  public function sesionesEventoMostrar($Id)
  {
    if (Auth::check()) {

      $user = Auth::user();

    } else {
      return redirect()->route('auth.login');
    }

    $events = Event::find($Id);
    $sessions = Session::where('event_id', $Id)->get();

  
    return view('links.sesionesEventoMostrar', compact('events','sessions'));
  }
  public function storeComprarEntradasSesion(Request $request)
  {

    if (empty($request->quantity)) {

      $request->validate([
        'name' => 'required',
        'price' => 'required',
        'nominal' => 'required',
      ]);

      $capacidadMaxima = session('capacidadMaxima');
      $quantity = $capacidadMaxima;
    } else {
      $quantity = $request->quantity;
    }

    $cantidadEntradas = $request->quantity;
    $capacidadMaxima = session('capacidadMaxima');


    $request->validate([
      'name' => 'required',
      'price' => 'required',
      'nominal' => 'required',
    ]);


    if ($cantidadEntradas > $capacidadMaxima) {
      $request->validate([
        'name' => 'required',
        'quantity' => 'lte:capacidadMaxima',
        'price' => 'required',
        'nominal' => 'required',
      ]);
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

    Feedback::flash('success', '¡La entrada se ha creado correctamente!');

    return redirect()->route('links.comprarEntradasSesion');
  }


  public function editarEvento($id)
  {
    // Obtener el evento a editar
    $evento = Event::findOrFail($id);

    $sesion = $evento->sessions->first();

    // Obtener todas las categorías
    $categorias = Category::all();

    $addresses = Event::select(['address'])->where('user_id', Auth::id())->get();

    $nameSites = Event::select(['name_site'])->where('user_id', Auth::id())->get();

    $capacitys = Event::select(['capacity'])->where('user_id', Auth::id())->get();

    $citys = Event::select(['city'])->where('user_id', Auth::id())->get();


    // Pasar el evento a la vista del formulario de creación/editar
    return view('links.crearEvento', compact('evento', 'sesion', 'categorias', 'addresses', 'nameSites', 'capacitys', 'citys'));
  }


}