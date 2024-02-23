<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OlvidadaContraTest extends TestCase
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

    public function test_send_reset_link_email()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create();

        // Simular la solicitud HTTP con un correo electrónico válido
        $response = $this->post(route('password.email'), ['email' => $user->email]);

        // Verificar que la respuesta sea exitosa
        $response->assertStatus(302); // Redirección después de enviar el correo


        // Verificar que se haya actualizado el token en la base de datos
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'reset_token' => $user->fresh()->reset_token, // Comprueba que el token se haya actualizado correctamente
        ]);
    }

    public function test_show_reset_password_view()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
        $response->assertViewIs('auth.forgotPwd');
    }

    

}
