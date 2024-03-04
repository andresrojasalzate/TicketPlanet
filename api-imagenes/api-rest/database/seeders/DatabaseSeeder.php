<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use  App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $user = User::factory()->count(1)->create()->first();

      $authController = new AuthController();

      $request = new Request([
          'email' => $user->email,
          'password' =>  $user->password,
      ]);

      // Llamar a la función login del controlador de autenticación
      $response = $authController->login($request);

      $token = $response->getContent();
      $this->command->info("token: $token");

    }
}
