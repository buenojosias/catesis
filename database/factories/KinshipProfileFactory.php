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
    public function definition()
    {
        $religion = $this->faker->randomElement([null,null,'Católico(a)','Católico(a)','Católico(a)','Católico(a)','Católico(a)','Protestante','Outra']);
        $catechizing = $religion === 'Católico(a)' ? $this->faker->boolean() : $this->faker->randomElement([null,false]);
        $has_baptism = $religion === 'Católico(a)' ? $this->faker->boolean() : $this->faker->randomElement([null,false]);
        $has_eucharist = $has_baptism ? $this->faker->boolean() : $this->faker->randomElement([null,false]);
        $has_chrism = $has_eucharist ? $this->faker->boolean() : $this->faker->randomElement([null,false]);
        $attends_church = $religion === 'Católico(a)' ? $this->faker->boolean() : $this->faker->randomElement([null,false]);
        $is_tither = $religion === 'Católico(a)' ? $this->faker->boolean() : $this->faker->randomElement([null,false]);

        return [
            'marital_status' => $this->faker->randomElement([null,'Solteiro(a)','Casado(a)','Viúvo(a)','Divorciado(a)']),
            'religion' => $religion,
            'catechizing' => $catechizing,
            'has_baptism' => $has_baptism,
            'has_eucharist' => $has_eucharist,
            'has_chrism' => $has_chrism,
            'attends_church' => $attends_church,
            'is_tither' => $is_tither,
            'musical_instrument' => $this->faker->randomElement([null,null,null,null,null,null,null,'Canto','Violão','Guitarra','Bateria','Baixo','Teclado','Violino']),
        ];
    }
}
