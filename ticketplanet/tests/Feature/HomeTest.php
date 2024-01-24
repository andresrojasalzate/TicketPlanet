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
        $categoria = Category::factory()->create();

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('p2345678'),
          ]);
    

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

          $response = $this->post(route('events.category'), ['category' => $categoria->id]);
          $response->assertOk();
          $response->assertViewHas('events');
      
          $events = $response->original->getData()['events'];
          $this->assertNotEmpty($events);
    }
}
