<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KinshipProfile>
 */
class KinshipProfileFactory extends Factory
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
            'marital_status' => $this->faker->randomElement($array = array (null,'Solteiro(a)','Casado(a)','Viuvo(a)','Divorciado(a)')),
            'catechizing' => $this->faker->randomElement($array = array(null,$this->faker->boolean())),
            'has_baptism' => $this->faker->randomElement($array = array(null,$this->faker->boolean())),
            'has_eucharist' => $this->faker->randomElement($array = array(null,$this->faker->boolean())),
            'attends_church' => $this->faker->boolean(),
            'is_tither' => $this->faker->randomElement($array = array(null,$this->faker->boolean())),
        ];
    }
}
