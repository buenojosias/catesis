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

    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $this->faker->realText($maxNbChars = 500, $indexSize = 2),
            'sequence' => rand(1,8),
        ];
    }
}
