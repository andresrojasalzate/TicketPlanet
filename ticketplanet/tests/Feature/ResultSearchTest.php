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


class ResultSearchTest extends TestCase
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

    public function test_it_returns_events_filtered_by_category(): void
    {
        $category = Category::factory()->create(['name' => 'Categoria']);

        $user = User::factory()->create();

        $event = Event::factory()->create(['name' => 'Evento 1', 'category_id' => $category->id, 'user_id' => $user->id]);
       
        $sesion = Session::factory()->create(['event_id' => $event->id]);
        
        Ticket::factory()->create(['session_id' => $sesion->id]);

        $this->withSession(['categoria' => $category->id]);

        $response = $this->get('/events/category');

        $response->assertOk();
        $response->assertViewHas('events');
  
       $events = $response->original->getData()['events'];
       $this->assertNotEmpty($events);

    }
}
