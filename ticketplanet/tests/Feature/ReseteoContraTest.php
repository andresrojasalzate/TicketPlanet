<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReseteoContraTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_reset_password_form()
    {
        // Creamos un usuario de prueba con un token de reseteo válido
        $user = User::factory()->create([
            'reset_token' => 'valid_token',
            'reset_token_created_at' => now()->subMinutes(30), // Dentro del tiempo de expiración
        ]);

        // Enviamos una solicitud GET a la ruta de restablecimiento de contraseña con el token válido
        $response = $this->get(route('password.reset', ['token' => $user->reset_token]));

        // Verificamos que la respuesta sea exitosa (código 200) y que la vista sea la correcta
        $response->assertStatus(200);
        $response->assertViewIs('auth.resetPwd');
        $response->assertViewHas('email', $user->email);
        $response->assertViewHas('token', $user->reset_token);
    }

    public function test_reset_password()
{
    // Creamos un usuario de prueba con un token de reseteo válido
    $user = User::factory()->create([
        'reset_token' => 'valid_token',
        'reset_token_created_at' => now()->subMinutes(30), // Dentro del tiempo de expiración
    ]);

    // Enviamos una solicitud POST para restablecer la contraseña con datos válidos
    $response = $this->post(route('password.update'), [
        'token' => $user->reset_token,
        'email' => $user->email,
        'password' => 'NewPassword123!',
        'password_confirmation' => 'NewPassword123!',
    ]);

    // Verificamos que la contraseña se haya restablecido correctamente y que el usuario se redirija a la página de inicio de sesión
    $response->assertRedirect(route('auth.login'));
    $this->assertTrue(Auth::attempt(['email' => $user->email, 'password' => 'NewPassword123!']));

    // Verificamos que el token de reseteo se haya eliminado
    $this->assertNull(User::find($user->id)->reset_token);
    $this->assertNull(User::find($user->id)->reset_token_created_at);

    // Verificar que se redireccione a la vista de contraseña expirada si el token ha expirado
    $user->reset_token_created_at = null;
    $user->save();

    $response = $this->post(route('password.update'), [
        'token' => $user->reset_token,
        'email' => $user->email,
        'password' => 'NewPassword123!',
        'password_confirmation' => 'NewPassword123!',
    ]);

    // Verificar que la redirección a la vista de contraseña expirada sea exitosa
    $response->assertRedirect(route('auth.expired'));
}
    public function test_expired_reset_password_link()
    {
        // Creamos un usuario de prueba con un token de reseteo inválido (expirado)
        $user = User::factory()->create([
            'reset_token' => 'expired_token',
            'reset_token_created_at' => now()->subHours(2), // Expirado
        ]);

        // Enviamos una solicitud GET a la ruta de restablecimiento de contraseña con el token inválido
        $response = $this->get(route('password.reset', ['token' => $user->reset_token]));

        // Verificamos que la respuesta sea exitosa (código 200) y que la vista sea la correcta
        $response->assertStatus(200);
        $response->assertViewIs('auth.expired');
    }
}
