<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Session;

class SessionTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_it_redirects_to_login_if_user_is_not_authenticated(): void
    {
       
        $response = $this->get('/sessions-promotor');

        $response->assertRedirect(route('auth.login'));
    }

    public function test_authenticated_user_can_access_sessions_promotor_route_and_receives_sessions(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

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

        $response = $this->get('/sessions-promotor');

        $response->assertStatus(200);

        $response->assertSee($evento->name);

    }
}
