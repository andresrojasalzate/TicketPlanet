<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assistant>
 */
class AssistantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nameAssistant' => '',
            'dniAssistant' => '',
            'phoneAssistant' => '',
            'compra_id'  => '',
            'ticket_id' => '',
        ];
    }
}
