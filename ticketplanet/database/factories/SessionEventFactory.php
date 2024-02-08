<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SessionEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $event = Event::inRandomOrder()->first();
        $maxCapacity = mt_rand(0, $event->capacity);

        return [
            'date' => fake()->date(),
            'time' => fake()->time(),
            'maxCapacity' => $maxCapacity,
            'ticketsSold' => mt_rand(0, 200),
        ];
    }
}
