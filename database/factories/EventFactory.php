<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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

    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween($startDate = '- 2 weeks', $endDate = '+3 months');
        $start_time = rand(8, 20) . ':' . Arr::random(['00', '15', '30', '45']) . ':00';
        $end_date = $this->faker->randomElement([null,null,null,\Carbon\Carbon::parse($start_date)->addDays(1)->format('Y-m-d')]);
        if($end_date && $start_time) { $end_time = rand(8, 20) . ':' . Arr::random(['00', '15', '30', '45']) . ':00'; }
        return [
            'title' => $this->faker->realText($maxNbChars = 32, $indexSize = 1),
            'description' => $this->faker->text($maxNbChars = 160),
            'start_date' => $start_date,
            'start_time' => $start_time,
            'end_date' => $end_date,
            'end_time' => $end_time ?? null,
        ];
    }
}
