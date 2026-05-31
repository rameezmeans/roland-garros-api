<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country' => fake()->randomElement([
                'POL',
                'BLR',
                'USA',
                'ITA',
                'CHN',
                'UKR',
                'NEU',
                'KAZ',
            ]),
            'ranking' => fake()->numberBetween(1, 100),
            'seed' => fake()->numberBetween(1, 32),
            'age' => fake()->numberBetween(18, 35),
            'handedness' => fake()->randomElement([
                'left',
                'right',
            ]),
            'img_url' => fake()->imageUrl(),
            'active' => true,
        ];
    }
}