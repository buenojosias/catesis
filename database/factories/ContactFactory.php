<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
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
            'phone' => randomElement(null,$this->faker->phoneNumber()),
            'whatsapp' => randomElement(null,$this->faker->phoneNumber()),
            'email' => randomElement(null,$this->faker->email()),
        ];
    }
}
