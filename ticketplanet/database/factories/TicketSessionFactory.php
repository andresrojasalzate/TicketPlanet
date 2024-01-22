<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => fake()->name(),
           'quantity' => mt_rand(0, 200),
           'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
           'nominal' => fake()->randomElement([true, false]), 
        ];
    }
}
