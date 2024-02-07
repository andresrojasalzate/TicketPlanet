<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Session;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sesion = Session::inRandomOrder()->first();
        
        return [
           'name' => fake()->name(),
           'quantity' => mt_rand(0, 200),
           'sold_tickets' => 0,
           'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
           'nominal' => fake()->randomElement([true, false]), 
           'session_id' => $sesion->id
        ];
    }
}
