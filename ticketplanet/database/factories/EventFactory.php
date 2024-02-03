<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

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

        $user = User::inRandomOrder()->first();
        $categoria = Category::inRandomOrder()->first();

        $capacity = mt_rand(0, 200);

        // Asegurarse de que maxCapacity no sea negativo
        $capacity = $capacity < 0 ? 0 : $capacity;

        return [
            'name' =>  fake()->name(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'name_site' => fake()->name(),
            'image' => "event_default.jpeg",
            'description' => fake()->text(),
            'finishDate' => fake()->date(),
            'finishTime' => fake()->time(),
            'visible' => fake()->randomElement([true, false]),
            'capacity' => $capacity,
            'user_id' => $user->id,
            'category_id' => $categoria->id,
        ];
    }
}
