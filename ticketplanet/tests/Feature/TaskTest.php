<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Session;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use \Database\Factories\EventFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    /*public function test_when_navigate_to_event_index_expect_show_event_list(): void
    {
        $response = $this->get('/events');
        $response->assertOk();
    }**/
    // public static function newValidEventTest(): array
    // {

    //     $task = \Database\Factories\EventFactory::

    //     return [

    //     ];
    // }
    public function test_aboutUs_view()
    {
        $response = $this->get(route('links.aboutus'));

        $response->assertStatus(200)
                 ->assertViewIs('links.aboutus');
    }
    public function test_legalNotice_view()
    {
        $response = $this->get(route('links.legalnotice'));

        $response->assertStatus(200)
                 ->assertViewIs('links.legalnotice');
    }
    public function test_validate_user_not_registed()
    {
        $response = $this->get(route('links.crearEvento'));
        $response->assertRedirect(route('auth.login'));
    }
    
    public function test_refirect_page_create_event_if_user_is_registed()
    {

        $user = User::factory()->create();
        $this->actingAs($user);


        $response = $this->get(route('links.crearEvento'));

        $response->assertStatus(200);

        $response->assertViewIs('links.crearEvento');

        $response->assertViewHasAll([
            'categorias',
            'addresses',
            'citys',
            'nameSites',
            'capacitys',
        ]);
    }
//     public function test_when_sesssion_have_QuantityTickets()
//     {
//         $sesion = Session::factory()->create([
//             'maxCapacity' => 100,
//         ]);

//         $this->session(['sesionId' => $sesion->id]);

//         $response = $this->get(route('links.comprarEntradas'));

//         $response->assertStatus(200);

//         $response->assertViewIs('links.comprarEntradas');

//         $response->assertViewHas('entradasRestantes', $sesion->maxCapacity);
//     }
//     public function test_when_session_dont_have_QuantityTickets()
// {
//     $sesion = Session::factory()->create([
//         'maxCapacity' => 150,
//     ]);

//     $response = $this->get(route('links.comprarEntradas'));

//     $response->assertStatus(200);

//     $response->assertViewIs('links.comprarEntradas');

//     $response->assertViewHas('entradasRestantes', $sesion->maxCapacity);
// }
public function test_when_user_is_registed_on_HomePromotor()
{

    $user = User::factory()->create();
    $this->actingAs($user);


    $response = $this->get(route('links.homePromotors'));


    $response->assertStatus(200)
             ->assertViewIs('links.homePromotors');
}
public function test_when_user_is_not_registed_on_HomePromotor()
{

    $response = $this->get(route('links.homePromotors'));


    $response->assertStatus(302)
             ->assertRedirect(route('auth.login'));
}
public function test_when_user_is_registed_redirect_to_SessionEvents()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('links.sessionEvents'));

    $response->assertStatus(200)
             ->assertViewIs('links.sessionEvents');
}
public function test_when_is_not_registed_on_SessionEvents()
{
    $response = $this->get(route('links.sessionEvents'));

    $response->assertStatus(302)
             ->assertRedirect(route('auth.login'));
}
// public function test_when_user_is_registed_on_multiplesSesiones()
// {
//   $user = User::factory()->create();
//   $this->actingAs($user);

//   $response = $this->get(route('links.multiplesSesiones', ['id' => 1]));

//   $response->assertViewIs('links.multiplesSesiones');
// }
public function test_when_user_is_not_registed_on_MultiplesSesiones()
{
  $response = $this->get(route('links.multiplesSesiones', ['id' => 1]));

  $response->assertStatus(302)
           ->assertRedirect(route('auth.login'));
}
    
    public function test_null_name_creating_event()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $categoria = Category::factory()->create();
        $evento = Event::factory()->create();

        $response = $this->post(route('links.store'), [
            'address' => 'Dirección del Evento',
            'city' => 'Ciudad del Evento',
            'name_site' => 'Nombre del Sitio',
            'image' => 'event_default.jpeg',
            'description' => 'Descripción del Evento',
            'finishDate' => '2024-12-31',
            'finishTime' => '18:30:00',
            'visible' => true,
            'capacity' => 50, 
            'categoria' => $categoria->id,
            'date' => '2024-12-31',
            'time' => '18:30:00',
            'maxCapacity' => 2,
            'event_id' => $evento->id,
            'ticketsSold' => 0
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);



    }
    public function test_null_capacity_creating_event()
{
  $user = User::factory()->create();
  $this->actingAs($user);

  $categoria = Category::factory()->create();

  

  $response = $this->post(route('links.store'), [
      'name' => 'Nombre del Evento',
      'address' => 'Dirección del Evento',
      'city' => 'Ciudad del Evento',
      'name_site' => 'Nombre del Sitio',
      'image' => 'event_default.jpeg',
      'description' => 'Descripción del Evento',
      'finishDate' => '2024-12-31',
      'finishTime' => '18:30:00',
      'visible' => true,
      'capacity' => null, 
      'categoria' => $categoria->id,
  ]);
  $response->assertStatus(302);
  $response->assertSessionHasErrors(['capacity']);

  $response->assertSessionHasErrors('capacity', 'El campo capacity debe ser mayor o igual que 1.');


}
public function test_validate_event()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $categoria = Category::factory()->create();

    $evento = Event::factory()->create();

    $imagenDePrueba = UploadedFile::fake()->image('test_image.jpg');

    $response = $this->post(route('links.store'), [
      'name' => 'Nombre del Evento',
      'address' => 'Dirección del Evento',
      'city' => 'Ciudad del Evento',
      'name_site' => 'Nombre del Sitio',
      'image' => $imagenDePrueba,
      'description' => 'Descripción del Evento',
      'finishDate' => '2024-12-31',
      'finishTime' => '18:30:00',
      'visible' => true,
      'capacity' => 2, 
      'categoria' => $categoria->id,
      'date' => null,
      'time' => '18:30:00',
      'maxCapacity' => 2,
      'event_id' => $evento->id,
      'ticketsSold' => 0
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['date']);

    $response->assertSessionHasErrors('date', 'El campo data no puede ser null.');

}


public function test_validation_quantity_larger_than_maxCapacity_ticket_page_create_event(){
  $user = User::factory()->create();
  $this->actingAs($user);

  $categoria = Category::factory()->create();

  $evento = Event::factory()->create();

  $session = Session::factory()->create();

  $evento = Event::create([
    'name' => "anderson",
    'address' => "direccion",
    'city' => "ciudad",
    'name_site' => "nombreSitio",
    'image' => "imagen",
    'description' => "descripcion",
    'finishDate' => date('Y-m-d'),
    'finishTime' => date('H:i:s'),
    'visible' => true,
    'capacity' => 100,
    'category_id' => $categoria->id,
    'user_id' => $user->id,
  ]);

  $sesion = Session::create([
    'date' => date('Y-m-d'),
    'time' => date('H:i:s'),
    'maxCapacity' => 100,
    'ticketsSold' => 100,
    'event_id' => $evento->id,
  ]);
  
  $response = $this->post(route('links.storeComprarEntradas'), [
    'name' => "nombre",
    'quantity' => 200,
    'price' => 10.0,
    'nominal' => true,
    'session_id' => $sesion->id,
]);


$response->assertStatus(302);
$response->assertSessionHasErrors(['quantity']);

$response->assertSessionHasErrors('quantity', 'La cantidad no puede ser superior al aforo maximo.');

}
// public function test_maxCapacity_is_0_page_sessions()
// {
//   $user = User::factory()->create();
//   $this->actingAs($user);

//   $categoria = Category::factory()->create();

//   $evento = Event::factory()->create();

//   $session = Session::factory()->create();

//   $evento = Event::create([
//     'name' => "anderson",
//     'address' => "direccion",
//     'city' => "ciudad",
//     'name_site' => "nombreSitio",
//     'image' => "imagen",
//     'description' => "descripcion",
//     'finishDate' => date('Y-m-d'),
//     'finishTime' => date('H:i:s'),
//     'visible' => true,
//     'capacity' => 0,
//     'category_id' => $categoria->id,
//     'user_id' => $user->id,
//   ]);

//   $sesion = Session::create([
//     'date' => date('Y-m-d'),
//     'time' => date('H:i:s'),
//     'maxCapacity' => 0,
//     'ticketsSold' => 0,
//     'event_id' => $evento->id,
//   ]);
  
//   $response = $this->post(route('links.storeComprarEntradasSesion'), [
//     'name' => "nombre",
//     'quantity' => 0,
//     'price' => 10.0,
//     'nominal' => true,
//     'session_id' => $sesion->id,
// ]);


// $response->assertStatus(302);
// $response->assertRedirect(route('links.sessionEvents'));


// }
public function test_validation_ticket(){
  $user = User::factory()->create();
  $this->actingAs($user);

  $categoria = Category::factory()->create();

  $evento = Event::factory()->create();

  $session = Session::factory()->create();

  $evento = Event::create([
    'name' => "anderson",
    'address' => "direccion",
    'city' => "ciudad",
    'name_site' => "nombreSitio",
    'image' => "imagen",
    'description' => "descripcion",
    'finishDate' => date('Y-m-d'),
    'finishTime' => date('H:i:s'),
    'visible' => true,
    'capacity' => 100,
    'category_id' => $categoria->id,
    'user_id' => $user->id,
  ]);

  $sesion = Session::create([
    'date' => date('Y-m-d'),
    'time' => date('H:i:s'),
    'maxCapacity' => 100,
    'ticketsSold' => 100,
    'event_id' => $evento->id,
  ]);
  
  $response = $this->post(route('links.storeComprarEntradas'), [
    'name' => "nombre",
    'quantity' => 100,
    'price' => null,
    'nominal' => true,
    'session_id' => $sesion->id,
]);


$response->assertStatus(302);
$response->assertSessionHasErrors(['price']);

$response->assertSessionHasErrors('price', 'El precio no puede ser null.');

}
public function test_validation_price_ticket()
{
  $user = User::factory()->create();
  $this->actingAs($user);

  $categoria = Category::factory()->create();

  $evento = Event::factory()->create();

  $session = Session::factory()->create();

  $evento = Event::create([
    'name' => "anderson",
    'address' => "direccion",
    'city' => "ciudad",
    'name_site' => "nombreSitio",
    'image' => "imagen",
    'description' => "descripcion",
    'finishDate' => date('Y-m-d'),
    'finishTime' => date('H:i:s'),
    'visible' => true,
    'capacity' => 100,
    'category_id' => $categoria->id,
    'user_id' => $user->id,
  ]);

  $sesion = Session::create([
    'date' => date('Y-m-d'),
    'time' => date('H:i:s'),
    'maxCapacity' => 100,
    'ticketsSold' => 100,
    'event_id' => $evento->id,
  ]);
  
  $response = $this->post(route('links.storeComprarEntradas'), [
    'name' => "nombre",
    'quantity' => '',
    'price' => null,
    'nominal' => true,
    'session_id' => $sesion->id,
]);
$response->assertStatus(302);
$response->assertSessionHasErrors(['price']);

$response->assertSessionHasErrors('price', 'El precio no puede ser null.');

}

// No se puede subir la imagen
// public function test_create_event()
// {
//   $user = User::factory()->create();
//   $this->actingAs($user);

//   $categoria = Category::factory()->create();

//   $imagenDePrueba = UploadedFile::fake()->image('test_image.jpg');

//   $response = $this->post(route('links.store'), [
//       'name' => 'a',
//       'address' => 'a',
//       'city' => 'a',
//       'name_site' => 'a',
//       'image' => $imagenDePrueba,
//       'description' => 'a',
//       'finishDate' => '2024-12-31',
//       'finishTime' => '18:30:00',
//       'visible' => true,
//       'capacity' => 2,
//       'category_id' => $categoria->id,
//       'user_id' => $user->id,
//       'date' => '2024-12-31',
//       'time' => '18:30:00',
//       'maxCapacity' => 2
//   ])->assertOk();

//   // Puedes obtener el nombre único de la imagen subida de esta manera
//   $nombre_unico = basename($response['image']);

//   $this->assertDatabaseHas('events', [
//       'name' => 'a',
//       'address' => 'a',
//       'city' => 'a',
//       'name_site' => 'a',
//       'image' => $nombre_unico, 
//       'description' => 'a',
//       'finishDate' => '2024-12-31',
//       'finishTime' => '18:30:00',
//       'visible' => true,
//       'capacity' => 2,
//       'category_id' => $categoria->id,
//       'user_id' => $user->id
//   ]);
// }
// No encuentra los valores

// public function test_create_session()
// {
  
//   $user = User::factory()->create();
//   $categoria = Category::factory()->create();

//   $evento = Event::factory()->create([
//     'name' => "anderson",
//     'address' => "direccion",
//     'city' => "ciudad",
//     'name_site' => "nombreSitio",
//     'image' => "imagen",
//     'description' => "descripcion",
//     'finishDate' => date('Y-m-d'),
//     'finishTime' => date('H:i:s'),
//     'visible' => true,
//     'capacity' => 100,
//     'category_id' => $categoria->id,
//     'user_id' => $user->id,
//   ]);
//   $this->post(route('links.store'),[
//     'date' => '2024-12-31',
//     'time' => '18:30:00',
//     'maxCapacity' => 100,
//     'ticketsSold' => 100,
//     'event_id' => $evento->id,
//   ]);

//   $this->assertDatabaseHas('sessions', [
//     'date' => '2024-12-31',
//     'time' => '18:30:00',
//     'maxCapacity' => 100,
//     'ticketsSold' => 100,
//     'event_id' => $evento->id,
//   ]);
// }
// Error table empty

// public function test_create_ticket()
// {
  
//   $user = User::factory()->create();
//   $categoria = Category::factory()->create();
//   $evento = Event::factory()->create([
//       'category_id' => $categoria->id,
//       'user_id' => $user->id,
//   ]);
//   $sesion = Session::factory()->create([
//       'event_id' => $evento->id,
//       'maxCapacity' => 200, 
//   ]);


//   $response = $this->post(route('links.storeComprarEntradas'), [
//       'name' => "nombre",
//       'quantity' => null,
//       'price' => 10,
//       'nominal' => true,
//       'session_id' => $sesion->id,
//   ]);


//   $response->assertStatus(302); 
//   $this->assertDatabaseHas('tickets', [
//       'name' => "nombre",
//       'quantity' => $sesion->maxCapacity, 
//       'price' => 10,
//       'nominal' => true,
//       'session_id' => $sesion->id,
//   ]);
// }
public function test_when_user_is_not_registed_on_AdministrarEvento_redirect_login()
{
    $response = $this->get(route('links.administrarEvents'));

    $response->assertStatus(302)
             ->assertRedirect(route('auth.login'));
}
public function test_validation_session_page_create_event(){
  $user = User::factory()->create();
  $this->actingAs($user);

  $categoria = Category::factory()->create();

  $evento = Event::factory()->create();

  
  $evento = Event::create([
    'name' => "anderson",
    'address' => "direccion",
    'city' => "ciudad",
    'name_site' => "nombreSitio",
    'image' => "imagen",
    'description' => "descripcion",
    'finishDate' => date('Y-m-d'),
    'finishTime' => date('H:i:s'),
    'visible' => true,
    'capacity' => 100,
    'category_id' => $categoria->id,
    'user_id' => $user->id,
  ]);

  $response = $this->post(route('links.store'), [
    'date' => null,
    'time' => '18:00:00',
    'maxCapacity' => 100,
    'ticketsSold' => 100,
    'event_id' => $evento->id,
]);


$response->assertStatus(302);
$response->assertSessionHasErrors(['date']);

$response->assertSessionHasErrors('date', 'La fecha no puede ser null.');

}
public function test_validation_session_page_sessions(){
  $user = User::factory()->create();
  $this->actingAs($user);

  $categoria = Category::factory()->create();

  $evento = Event::factory()->create();

  
  $evento = Event::create([
    'name' => "anderson",
    'address' => "direccion",
    'city' => "ciudad",
    'name_site' => "nombreSitio",
    'image' => "imagen",
    'description' => "descripcion",
    'finishDate' => date('Y-m-d'),
    'finishTime' => date('H:i:s'),
    'visible' => true,
    'capacity' => 100,
    'category_id' => $categoria->id,
    'user_id' => $user->id,
  ]);

  $response = $this->post(route('links.crearMultiplesSesiones', ['id' => $evento->id]), [
    'date' => null,
    'time' => '18:00:00',
    'maxCapacity' => 100,
    'ticketsSold' => 100,
    'event_id' => $evento->id,
]);


$response->assertStatus(302);
$response->assertSessionHasErrors(['date']);

$response->assertSessionHasErrors('date', 'La fecha no puede ser null.');

}

}
