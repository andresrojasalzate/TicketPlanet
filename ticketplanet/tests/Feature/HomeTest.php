<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use App\Models\Event;
use App\Models\Session;
use App\Models\Ticket;

class HomeTest extends TestCase
{

    use RefreshDatabase;

    public function test_when_navigate_to_home():void
    {
        
        Category::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewHas('categories');
    }

    public function test_when_click_ver_mas():void
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

          $response = $this->post(route('events.category'), ['category' => $categoria->id]);
          $response->assertOk();
          $response->assertViewHas('events');
      
          $events = $response->original->getData()['events'];
          $this->assertNotEmpty($events);
    }
}
