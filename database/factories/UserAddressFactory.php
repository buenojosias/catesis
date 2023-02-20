<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address' => $this->faker->streetAddress(),
            'complement' => $this->faker->randomElement(null,null,'Apto. '. rand(10,100),'Casa '. rand(1,4)),
            'district' => $this->faker->randomElement($array = array ('Pilarzinho','Pilarzinho','Pilarzinho','Pilarzinho','Pilarzinho','Abranches','Taboão','Vista Alegre'))
        ];
    }
}
