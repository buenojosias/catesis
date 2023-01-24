<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'birthday' => $this->faker->dateTimeBetween('-50 years', '-16 years'),
            'marital_status' => $this->faker->randomElement([null,'Solteiro(a)','Casado(a)','Solteiro(a)','Casado(a)','Solteiro(a)','Casado(a)','Solteiro(a)','Casado(a)','Viuvo(a)','Divorciado(a)']),
        ];
    }
}
