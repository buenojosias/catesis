<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'community_id' => rand(1, 4),
            'grade_id' => rand(1, 8),
            'name' => $this->faker->firstName().' '.$this->faker->lastName().' '.$this->faker->lastName(),
            'birth' => $this->faker->dateTimeBetween('-16 years', '-8 years'),
        ];
    }
}
