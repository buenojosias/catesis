<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentProfile>
 */
class StudentProfileFactory extends Factory
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
            'gender' => $this->faker->randomElement($array = array ('male','female')),
            'naturalness' => $this->faker->city(),
            'has_baptism' => $this->faker->boolean(),
            'married_parents' => $this->faker->boolean()
        ];
    }
}
