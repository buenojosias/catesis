<?php

namespace Database\Seeders;

use App\Models\Encounter;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class EncounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Encounter::query()->truncate();
        $dates = ['2023-03-04','2023-03-11','2023-03-18','2023-03-25','2023-04-01','2023-04-08','2023-04-15','2023-04-29','2023-05-06','2023-05-13','2023-05-20','2023-05-27','2023-06-03','2023-06-10','2023-06-17','2023-06-24'];
        $groups = Group::where('year', 2023)->with('grade')->get();
        foreach($groups as $group) {
            $themes = $group->grade->themes()->pluck('id');
            foreach($dates as $date) {
                $group->encounters()->create([
                    'date' => $date,
                    'method' => Arr::random(['presencial','familiar']),
                    'theme_id' => $themes->random(),
                ]);
            }
        }
    }
}
