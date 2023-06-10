<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'birth' => fake()->numberBetween(1970, date("Y")),
            'nationality' => fake()->country(),
            'sport' => fake()->randomElement([
                'football', 'cricket', 'rugby', 'hockey',
                'basketball', 'baseball', 'volleyball'
            ]),
            'role' => fake()->word(),
            'trophies' => fake()->numberBetween(0, 30)
        ];
    }
}
