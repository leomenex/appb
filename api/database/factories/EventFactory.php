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
            'name' => 'Visitação Mirante',
            'description' => fake('pt_BR')->randomHtml,
            'date' => fake()->dateTimeBetween('+1 day', '+2 months', 'America/Boa_Vista'),
            'is_draft' => true,
        ];
    }
}
