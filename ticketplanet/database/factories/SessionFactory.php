<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $evento = Event::inRandomOrder()->first();
        
        $maxCapacity = mt_rand(0, $evento->capacity);
        $maxCapacity = $maxCapacity < 0 ? 0 : $maxCapacity;
        return [
            'date' => fake()->date(),
            'time' => fake()->time(),
            'maxCapacity' => $maxCapacity,
            'ticketsSold' => mt_rand(0, 200),
            'event_id' => $evento->id
        ];
    }
}
