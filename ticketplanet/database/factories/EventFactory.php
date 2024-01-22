<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->name(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'name_site' => fake()->name(),
            'image' => fake()->image(),
            'description' => fake()->text(),
            'finishDate' => fake()->date(),
            'finishTime' => fake()->time(),
            'visible' => fake()->randomElement([true, false]),
            'capacity' => mt_rand(0, 200),
            'user_id' => 2,
            'category_id' => 1,
        ];
    }
}
