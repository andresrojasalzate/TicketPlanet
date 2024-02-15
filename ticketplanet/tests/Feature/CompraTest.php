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

class CompraTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_mostrar_compra()
    {

        // Crear un usuario para asociarlo al evento
        $user = User::factory()->create();

        // Crear datos de prueba
        // Crear una categoría
        $categoria = Category::factory()->create();

        // Crear datos de prueba
        $evento = Event::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoria->id,
        ]);
        $sesion = Session::factory()->create(['event_id' => $evento->id]);
        $tickets = Ticket::factory()->count(3)->create(['session_id' => $sesion->id]);
        $totalPrice = 500; // Precio total de la compra
        $cantidadEntradas = [
            $tickets[0]->id => 2,
            $tickets[1]->id => 3,
            $tickets[2]->id => 1,
        ];

        // Simular la solicitud HTTP con los parámetros necesarios
        $response = $this->get(route('mostrar.compra', [
            'evento_id' => $evento->id,
            'sesion' => $sesion->id,
            'sold_tickets' => [
                $tickets[0]->id => 2,
                $tickets[1]->id => 3,
                $tickets[2]->id => 1,
            ],
            'total_price' => 500,
        ]));

        // Verificar que la respuesta sea exitosa
        $response->assertOk();

        // Verificar que se estén pasando los datos correctos a la vista
        $response->assertViewHas('evento', $evento);
        $response->assertViewHas('sesionId', $sesion->id);
        $response->assertViewHas('selectedDate', $sesion->date);
        $response->assertViewHas('selectedTime', $sesion->time);
        $response->assertViewHas('tickets', $tickets);
        $response->assertViewHas('cantidadEntradas', $cantidadEntradas);
        $response->assertViewHas('totalPrice', $totalPrice);
        // Otros datos que se deberían pasar a la vista...

        // Verificar que la vista devuelta sea la correcta
        $response->assertViewIs('compra.compra');

       
    }
}
