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
        $has_baptism = $this->faker->boolean();
        if($has_baptism) {
            $baptism_date = $this->faker->dateTimeBetween('-8 years', '-1 years');
            $baptism_church = $this->faker->randomElement([null,'Paróquia São Marcos','Santuário Nossa Senhora do Perpétuo Socorro','Igreja Nossa Senhora das Mercês','Igreja do Rosário']);
        } else {
            $baptism_date = null;
            $baptism_church = null;
        }
        return [
            'gender' => $this->faker->randomElement($array = array ('male','female')),
            'naturalness' => $this->faker->randomElement(['Curitiba/PR','Curitiba/PR','Curitiba/PR','Curitiba/PR','Almirante Tamandaré/PR','São José dos Pinhais/PR',$this->faker->city().'/'.$this->faker->stateAbbr()]),
            'has_baptism' => $has_baptism,
            'married_parents' => $this->faker->boolean(),
            'baptism_date' => $baptism_date,
            'baptism_church' => $baptism_church,
        ];
    }
}
