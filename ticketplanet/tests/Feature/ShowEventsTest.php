<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Session;
use App\Models\Category;
use App\Models\User;
use App\Models\Ticket;

class ShowEventsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_mostrar_evento_existente()
    {

        // Creamos una categoria para probar
        $user = User::factory()->create();

       
        // Creamos una categoria para probar
        $categorias = Category::factory()->create();

        // Creamos un evento para probar
        $evento = Event::factory()->create([
            'category_id'=>$categorias->id,
            'user_id'=>$user->id
        ]);

        // Creamos una sesion para probar
        $sesion = Session::factory()->create([
            'event_id'=>$evento->id
        ]);

         // Creamos una categoria para probar
         $ticket = Ticket::factory()->create([
            'session_id'=>$sesion->id
        ])->first();;

        

        // Simulamos una solicitud GET a la ruta mostrarEvento con el ID del evento creado
        $response = $this->get(route('events.mostrar', ['id' => $evento->id]));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que la vista tenga los datos del evento y los tickets
        $response->assertViewHas('evento', $evento);
        $response->assertViewHas('tickets', $ticket);
        // $response->assertViewHas('sesion', $sesion);
       
    
    }

    public function test_mostrar_evento_no_existente()
    {
        // Simulamos una solicitud GET a la ruta mostrarEvento con un ID que no existe
        $response = $this->get(route('events.mostrar', ['id' => 999]));

        // Verificamos que la respuesta sea un error 404 (not found)
        $response->assertStatus(404);
    }
}
