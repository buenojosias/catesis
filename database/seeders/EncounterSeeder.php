<?php

namespace Database\Seeders;

use App\Models\Encounter;
use App\Models\Group;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EncounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;'); Encounter::query()->truncate();
        $dates = ['2023-01-14','2023-03-21','2023-03-28','2023-02-04','2023-02-11','2023-02-18','2023-02-25','2023-03-04','2023-03-11','2023-03-18','2023-03-25','2023-04-01','2023-04-08','2023-04-15','2023-04-29','2023-05-06','2023-05-13','2023-05-20','2023-05-27'];
        $all_themes = Theme::all();
        $groups = Group::where('year', 2023)->with('grade.themes')->get();
        foreach($groups as $group) {
            $themes = $all_themes->where('grade_id', $group->grade_id)->pluck('id');
            foreach($dates as $date) {
                $group->encounters()->create([
                    'date' => $date,
                    'method' => Arr::random(['Presencial','Familiar']),
                    'theme_id' => $themes->random(),
                ]);
            }
        }
    }
}
