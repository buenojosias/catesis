<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'title' => $this->faker->realText($maxNbChars = 32, $indexSize = 1),
            'description' => $this->faker->realText($maxNbChars = 500, $indexSize = 2),
            'sequence' => rand(1,8),
        ];
    }
}
