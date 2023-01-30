<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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
        $starts_at = $this->faker->dateTimeBetween($startDate = '- 2 weeks', $endDate = '+3 months', $timezone = null);
        $ends_at = \Carbon\Carbon::parse($starts_at)->addDays(1);
        return [
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $this->faker->text($maxNbChars = 160),
            'starts_at' => $starts_at,
            'ends_at' => $this->faker->randomElement([null,null,$ends_at]),
        ];
    }
}
