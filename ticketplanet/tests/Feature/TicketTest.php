<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Session;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   */
  public function test_example(): void
  {
    $response = $this->get('/');

    $response->assertStatus(200);
  }
  public function test_validation_ticket_page_create_event()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $categoria = Category::factory()->create();

    $evento = Event::factory()->create();

    $sesion = Session::factory()->create();

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
  public function test_validation_price_ticket_and_quantity_page_sessions()
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

    $response = $this->post(route('links.storeComprarEntradasSesion'), [
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
  public function test_validation_quantity_larger_than_maxCapacity_ticket_page_sessions()
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

    $response = $this->post(route('links.storeComprarEntradasSesion'), [
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


//   public function test_create_ticket_page_sessions()
//   {

//     $user = User::factory()->create();


//     $evento = Event::factory()->create();


//     $sesion = Session::factory()->create([
//         'event_id' => $evento->id,
//         'maxCapacity' => 200,
//     ]);


//     Ticket::create([
//         'name' => 'nombre',
//         'quantity' => 200,
//         'price' => 10,
//         'nominal' => true,
//         'session_id' => $sesion->id,
//     ]);


//     $this->assertDatabaseHas('tickets', [
//         'name' => 'nombre',
//         'quantity' => 200,
//         'price' => 10,
//         'nominal' => true,
//         'session_id' => $sesion->id,
//     ]);
// }
}
