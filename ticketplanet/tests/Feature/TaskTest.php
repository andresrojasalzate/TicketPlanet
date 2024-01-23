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
  //use RefreshDatabase;
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
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);
      
      
    }
    public function test_when_write_on_seeker_with_min_show_event_list(): void
    {
      $response = $this->post(route('events.search'), ['busqueda' => 'a', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);

    }

    public function test_when_write_on_seeker_with_accent_show_event_list(): void
    {
      $response = $this->post(route('events.search'), ['busqueda' => 'á', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);

    }

    public function test_when_write_on_seeker_with_category_show_event_list(): void
    {
      $response = $this->post(route('events.search'), ['busqueda' => 'á', 'category' => 1]);
      $response->assertOk();
      $response->assertViewHas('events');
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);

    }
}
