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

    public function definition()
    {
        return [
            'phone' => $this->faker->randomElement([null,null,$this->faker->phoneNumber()]),
            'whatsapp' => $this->faker->randomElement([null,$this->faker->phoneNumber()]),
            'email' => $this->faker->randomElement([null,null,null,$this->faker->email()]),
            'facebook' => $this->faker->randomElement([null,null,null,'https://facebook.com/'.$this->faker->userName()]),
            'instagram' => $this->faker->randomElement([null,null,null,$this->faker->userName()]),
        ];
    }
}
