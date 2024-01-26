<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Session;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Database\Factories\EventFactory;

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
    public function test_when_write_on_seeker_with_mayus_show_event_list(): void
   {
      
      $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('p2345678'),
      ]);

      $categoria = Category::factory()->create();

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
      
      Ticket::create([
        'name' => "nombre",
        'quantity' => 100,
        'price' => 10.0,
        'nominal' => true,
        'session_id' => $sesion->id,
      ]);

      $response = $this->post(route('events.search'), ['busqueda' => 'A', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
    //   $events = $response->original->getData()['events'];
    //   $this->assertNotEmpty($events);
      
      
    }
    public function test_when_write_on_seeker_with_min_show_event_list(): void
    {

      $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('p2345678'),
      ]);

      $categoria = Category::factory()->create();

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
      
      Ticket::create([
        'name' => "nombre",
        'quantity' => 100,
        'price' => 10.0,
        'nominal' => true,
        'session_id' => $sesion->id,
      ]);


      $response = $this->post(route('events.search'), ['busqueda' => 'a', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
    //   $events = $response->original->getData()['events'];
    //   $this->assertNotEmpty($events);

    }

    public function test_when_write_on_seeker_with_accent_show_event_list(): void
    {

      $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('p2345678'),
      ]);

      $categoria = Category::factory()->create();

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
      
      Ticket::create([
        'name' => "nombre",
        'quantity' => 100,
        'price' => 10.0,
        'nominal' => true,
        'session_id' => $sesion->id,
      ]);


      $response = $this->post(route('events.search'), ['busqueda' => 'á', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
    //   $events = $response->original->getData()['events'];
    //   $this->assertNotEmpty($events);

    }

    public function test_when_write_on_seeker_with_category_show_event_list(): void
    {

      $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('p2345678'),
      ]);

      $categoria = Category::factory()->create();

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
      
      Ticket::create([
        'name' => "nombre",
        'quantity' => 100,
        'price' => 10.0,
        'nominal' => true,
        'session_id' => $sesion->id,
      ]);


      $response = $this->post(route('events.search'), ['busqueda' => 'á', 'category' => $categoria->id]);
      $response->assertOk();
      $response->assertViewHas('events');
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);

    }
    public function test_null_name_creating_event()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $categoria = Category::factory()->create();

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
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);


        //$this->assertEquals(['El campo name es obligatorio'], session('errors')->get('name'));

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

          public function test_create_new_event(): void
          {
            $user = User::factory()->create([
              'email' => 'prueba@example.com',
              'password' => bcrypt('p2345678'),
            ]);
      
            $categoria = Category::factory()->create();
      
            $evento = Event::create([
              'name' => "TestCrearEvento",
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
            
            Ticket::create([
              'name' => "nombre",
              'quantity' => 100,
              'price' => 10.0,
              'nominal' => true,
              'session_id' => $sesion->id,
            ]);

            $this->assertDatabaseHas('events', [
              'name' => 'TestCrearEvento',
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
              'user_id' => $user->id
              
          ]);
  
          $evento = Event::where('name', 'TestCrearEvento')->first();
  
          $this->assertDatabaseHas('sessions', [
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'maxCapacity' => 100,
            'event_id' => $evento->id
          ]);
  
          $sesion = Session::where('event_id', $evento->id)->first();
  
          $this->assertDatabaseHas('tickets', [
              'session_id' => $sesion->id,
              'name' => 'nombre',
              'quantity' => 100
          ]);

  }
}
