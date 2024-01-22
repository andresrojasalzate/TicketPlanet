<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
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

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('p2345678'),
        ]);

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'p2345678',
        ]);

        $response->assertRedirect(route('links.homePromotors'));

        $this->assertAuthenticatedAs($user);
    }


    public function test_login_form_has_required_fields(): void
    {
        $response = $this->get(route('auth.login'));

        $response->assertSee('Correo electrónico');
        $response->assertSee('Contraseña');
    }

    public function test_login_view_displays_session_messages(): void
    {
        $response = $this->withSession(['status' => ['message' => 'Mensaje de prueba']])->get(route('auth.login'));

        $response->assertSee('Mensaje de prueba');
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('auth.logout'));

        $response->assertRedirect('/login');
        $this->assertGuest();
    }


}
