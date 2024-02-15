<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Valoracion;
use App\Mail\ValidacionMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ValoracionTest extends TestCase
{
    use RefreshDatabase;

    public function test_mostrar_formulario()
    {

        // Crear un usuario
        $user = User::factory()->create();

        // Crear un evento asociado al usuario
        $evento = Event::factory()->create([
            'category_id' => Category::factory()->create()->id,
            'user_id' => $user->id,
        ]);

        // Simular la solicitud HTTP para mostrar el formulario de valoración
        $response = $this->get(route('valoracion.form', ['eventoId' => $evento->id]));

        // Verificar que se recibe una respuesta exitosa
        $response->assertSuccessful();

        // Verificar que se devuelve la vista correcta
        $response->assertViewIs('valoracion.formValoracion');

        // Verificar que la vista recibe el evento ID correctamente
        $response->assertViewHas('eventoId', $evento->id);
    }

    public function test_enviar_correo_valoracion()
    {
        // Crear un usuario autenticado
        $user = User::factory()->create();

        // Crear un evento
        $evento = Event::factory()->create([
            'category_id' => Category::factory()->create()->id,
        ]);

        // Simular la solicitud HTTP para enviar el correo de valoración
        $response = $this->actingAs($user)->post(route('enviar.correo.valoracion'), [
            'evento' => $evento->id,
        ]);

        // Verificar que se redirige de vuelta con un mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('status', '¡Correo de valoración enviado con éxito!');

    }

    public function test_guardar_valoracion()
    {
        $user = User::factory()->create();
        $evento = Event::factory()->create([
            'category_id' => Category::factory()->create()->id,
            'user_id' => $user->id, // Asignar el ID del usuario al evento
        ]);

        // Simular la solicitud HTTP para guardar la valoración
        $response = $this->post(route('guardarValoracion'), [
            'nombre' => 'Usuario Test',
            'caraSeleccionada' => 'Feliz',
            'puntuacionSeleccionada' => 5,
            'tituloComentario' => 'Excelente evento',
            'comentario' => 'Realmente disfruté el evento. Fue una experiencia increíble.',
            'evento_id' => $evento->id,
        ]);

        // Verificar que se redirige de vuelta con un mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('valoracionGuardada', true);

        // Verificar que se guarda la valoración en la base de datos
        $this->assertDatabaseHas('valoration', [
            'nombre' => 'Usuario Test',
            'caraSeleccionada' => 'Feliz',
            'puntuacionSeleccionada' => 5,
            'tituloComentario' => 'Excelente evento',
            'comentario' => 'Realmente disfruté el evento. Fue una experiencia increíble.',
            'event_id' => $evento->id,
        ]);

        // Verificar que se registra en el log
        Log::info('Valoración guardada en la base de datos');
    }

}


