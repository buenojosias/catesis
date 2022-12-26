<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'birth' => $this->faker->dateTimeBetween('-50 years', '-16 years'),
            'marital_status' => $this->faker->randomElement($array = array (null,'Solteiro(a)','Casado(a)','Solteiro(a)','Casado(a)','Solteiro(a)','Casado(a)','Solteiro(a)','Casado(a)','Viuvo(a)','Divorciado(a)')),
        ];
    }
}
