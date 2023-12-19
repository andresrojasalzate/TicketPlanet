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
        $eventsIdsArray = Event::pluck('id');
        $lengthEventId = count($eventsIdsArray);
        $positionRandom = random_int(0, $lengthEventId - 1);

        return [
            'date' => fake()->date(),
            'time' => fake()->time(),
            'price' =>  mt_rand(10.0 * 10, 20.0 * 10) / 10,
            'event_id' => $eventsIdsArray[$positionRandom] ,
        ];
    }
}
