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

    public function test_when_no_write_on_seeker(): void
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


      $response = $this->post(route('events.search'), ['busqueda' => '', 'category' => '']);
      $response->assertOk();
      $response->assertSee('No se han encotrado eventos');

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

public function test_create_event()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $categoria = Category::factory()->create();

    $evento = Event::factory()->create();

    $imagenDePrueba = UploadedFile::fake()->image('test_image.jpg');

    
    $response = $this->post(route('links.store'), [
        'name' => 'a',
        'address' => 'a',
        'city' => 'a',
        'name_site' => 'a',
        'image' => $imagenDePrueba,
        'description' => 'a',
        'finishDate' => '2024-12-31',
        'finishTime' => '18:30:00',
        'visible' => true,
        'capacity' => 2,
        'category_id' => $categoria->id,
        'user_id' => $user->id
    ])->assertOk();
    
   
    $nombre_unico = $response['image'];
    
    
    $this->assertDatabaseHas('events', [
        'name' => 'a',
        'address' => 'a',
        'city' => 'a',
        'name_site' => 'a',
        'image' => $nombre_unico, 
        'description' => 'a',
        'finishDate' => '2024-12-31',
        'finishTime' => '18:30:00',
        'visible' => true,
        'capacity' => 2,
        'category_id' => $categoria->id,
        'user_id' => $user->id
    ]);



}
}
