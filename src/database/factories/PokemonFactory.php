<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pokemon>
 */
class PokemonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pokedex_number' => fake()->numberBetween(int1: 1, int2: 1500),
            'name' => fake()->name(),
            'height' => fake()->numberBetween(int1: 1),
            'weight' => fake()->numberBetween(int1: 1),
        ];
    }
}
