<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use App\Models\Session;
use App\Models\Ticket;


class EventTest extends TestCase
{
   
    use RefreshDatabase;
    
    public function test_when_write_on_seeker_with_mayus_show_event_list(): void
   {
      
      $user = User::factory()->create();

      $categoria = Category::factory()->create();

      $evento = Event::factory()->create([
        'name' => 'Anderson',
        'category_id' => $categoria->id,
        'user_id' => $user->id,
      ]);

      $sesion = Session::factory()->create([
        'event_id' => $evento->id,
      ]);
      
      Ticket::factory()->create([
        'session_id' => $sesion->id,
      ]);

      $response = $this->post(route('events.search'), ['busqueda' => 'ANDERSON', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');      
    }

    public function test_when_write_on_seeker_with_min_show_event_list(): void
    {

        $user = User::factory()->create();

        $categoria = Category::factory()->create();
  
        $evento = Event::factory()->create([
          'city' => 'ANDERSON',
          'category_id' => $categoria->id,
          'user_id' => $user->id,
        ]);
  
        $sesion = Session::factory()->create([
          'event_id' => $evento->id,
        ]);
        
        Ticket::factory()->create([
          'session_id' => $sesion->id,
        ]);


      $response = $this->post(route('events.search'), ['busqueda' => 'anderson', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
       $events = $response->original->getData()['events'];
       $this->assertNotEmpty($events);

    }

    public function test_when_write_on_seeker_with_accent_show_event_list(): void
    {

        $user = User::factory()->create();

        $categoria = Category::factory()->create();
  
        $evento = Event::factory()->create([
          'name_site' => 'Andersón',
          'category_id' => $categoria->id,
          'user_id' => $user->id,
        ]);
  
        $sesion = Session::factory()->create([
          'event_id' => $evento->id,
        ]);
        
        Ticket::factory()->create([
          'session_id' => $sesion->id,
        ]);
        


      $response = $this->post(route('events.search'), ['busqueda' => 'anderson', 'category' => null]);
      $response->assertOk();
      $response->assertViewHas('events');
  
       $events = $response->original->getData()['events'];
       $this->assertNotEmpty($events);

    }

    public function test_when_write_on_seeker_with_category_show_event_list(): void
    {

        $user = User::factory()->create();

        $categoria = Category::factory()->create();
  
        $evento = Event::factory()->create([
          'name' => 'Anderson',
          'category_id' => $categoria->id,
          'user_id' => $user->id,
        ]);
  
        $sesion = Session::factory()->create([
          'event_id' => $evento->id,
        ]);
        
        Ticket::factory()->create([
          'session_id' => $sesion->id,
        ]);


      $response = $this->post(route('events.search'), ['busqueda' => 'Anderson', 'category' => $categoria->id]);
      $response->assertOk();
      $response->assertViewHas('events');
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);

    }

    public function test_when_no_write_on_seeker_with_category(): void
    {

        $user = User::factory()->create();

        $categoria = Category::factory()->create();
  
        $evento = Event::factory()->create([
          'category_id' => $categoria->id,
          'user_id' => $user->id,
        ]);
  
        $sesion = Session::factory()->create([
          'event_id' => $evento->id,
        ]);
        
        Ticket::factory()->create([
          'session_id' => $sesion->id,
        ]);

      $response = $this->post(route('events.search'), ['busqueda' => '', 'category' => $categoria->id]);
      $response->assertOk();
      $response->assertViewHas('events');
  
      $events = $response->original->getData()['events'];
      $this->assertNotEmpty($events);

    }

    public function test_when_no_write_on_seeker_with_no_category(): void
    {

        $user = User::factory()->create();

        $categoria = Category::factory()->create();
  
        $evento = Event::factory()->create([
          'category_id' => $categoria->id,
          'user_id' => $user->id,
        ]);
  
        $sesion = Session::factory()->create([
          'event_id' => $evento->id,
        ]);
        
        Ticket::factory()->create([
          'session_id' => $sesion->id,
        ]);

      $response = $this->post(route('events.search'), ['busqueda' => '', 'category' =>'']);
      $response->assertOk();
      $response->assertViewHas('events');

      $response->assertSee('No se han encotrado eventos');

    }

    public function test_it_returns_events_based_on_search_and_category(): void
    {
        
        $category = Category::factory()->create(['name' => 'Categoría']);

        $user = User::factory()->create();

        $event = Event::factory()->create(['name' => 'Evento 1', 'category_id' => $category->id, 'user_id' => $user->id]);
       
        $sesion = Session::factory()->create(['event_id' => $event->id]);
        
        Ticket::factory()->create(['session_id' => $sesion->id]);

        $this->withSession(['busqueda' => 'Evento', 'category' => $category->id]);

        $response = $this->get('/events');

        $response->assertOk();
        $response->assertViewHas('events');
  
       $events = $response->original->getData()['events'];
       $this->assertNotEmpty($events);
    }

    
}
