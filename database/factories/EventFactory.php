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
        $startsAt = $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+10 days', $timezone = null);
        $endsAt = \Carbon\Carbon::parse($startsAt)->addDays(1);
        return [
            'user_id' => rand(1, 5),
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $this->faker->text($maxNbChars = 160),
            'startsAt' => $startsAt,
            'endsAt' => $this->faker->randomElement([null,null,$endsAt]),
        ];
    }
}
