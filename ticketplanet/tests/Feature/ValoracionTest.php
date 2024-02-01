<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Valoracion;
use App\Mail\ValidacionMail;
use Illuminate\Support\Facades\Log;

class ValoracionTest extends TestCase
{
    public function un_usuario_autenticado_puede_enviar_un_correo_de_valoracion()
    {
        Mail::fake();
        $usuario = User::factory()->create();
        $evento = Event::factory()->create();

        $response = $this->actingAs($usuario)->post(route('enviar.correo.valoracion'), [
            'evento' => $evento->id
        ]);

        $response->assertSessionHas('status', '¡Correo de valoración enviado con éxito!');
        Mail::assertSent(ValidacionMail::class, function ($mail) use ($usuario, $evento) {
            return $mail->hasTo($usuario->email) &&
                $mail->evento->id === $evento->id;
        });
    }

    /** @test */
    public function un_usuario_no_autenticado_no_puede_enviar_un_correo_de_valoracion()
    {
        Mail::fake();
        $evento = Event::factory()->create();

        $response = $this->post(route('enviar.correo.valoracion'), [
            'evento' => $evento->id
        ]);

        $response->assertRedirect(route('auth.login'));
        Mail::assertNotSent(ValidacionMail::class);
    }

    /** @test */
    public function se_puede_guardar_una_valoracion()
    {
        $evento = Event::factory()->create();
        $valoracionData = [
            'nombre' => 'John Doe',
            'caraSeleccionada' => 'faceGood',
            'puntuacionSeleccionada' => 4,
            'tituloComentario' => 'Gran evento',
            'comentario' => 'Me encantó, definitivamente volveré.'
        ];

        $response = $this->post(route('guardarValoracion'), array_merge($valoracionData, ['evento_id' => $evento->id]));

        $response->assertSessionHas('valoracionGuardada', true);
        $this->assertDatabaseHas('valoration', $valoracionData);
    }

    /** @test */
    public function se_validan_los_datos_de_la_valoracion()
    {
        $evento = Event::factory()->create();

        $response = $this->post(route('guardarValoracion'), ['evento_id' => $evento->id]);

        $response->assertSessionHasErrors([
            'nombre',
            'caraSeleccionada',
            'puntuacionSeleccionada',
            'tituloComentario',
            'comentario'
        ]);
    }

}


