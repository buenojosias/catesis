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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('encounter_student')->truncate();
        Encounter::query()->truncate();

        $dates = ['2023-01-07','2023-01-14','2023-01-21','2023-01-28','2023-02-04','2023-02-11','2023-02-18','2023-02-25','2023-03-04','2023-03-11','2023-03-18','2023-03-25','2023-04-01','2023-04-08','2023-04-15','2023-04-22','2023-04-29','2023-05-06','2023-05-13','2023-05-20','2023-05-27','2023-06-03'];
        $all_themes = Theme::all();
        $groups = Group::where('year', 2023)->with('grade.themes')->get();
        foreach($groups as $group) {
            $themes = $all_themes->where('parish_id', $group->parish_id)->where('grade_id', $group->grade_id);
            foreach($dates as $key => $date) {
                $theme_id = $themes->where('sequence', $key+1)->first()->id ?? null;
                $group->encounters()->create([
                    'parish_id' => $group->parish_id,
                    'date' => $date,
                    'method' => Arr::random(['Presencial','Familiar']),
                    'theme_id' => $theme_id,
                ]);
            }
        }

        # Registrar algumas frequências
        $groups = Group::query()
            ->whereHas('encounters')
            ->with('students', function ($query) {
                $query->wherePivot('status', 'Ativo');
            })
            ->with('encounters', function ($query) {
                $query->where('date', '2023-01-07')->orWhere('date', '2023-01-14')->orWhere('date', '2023-01-21');
            })
            ->get();
        foreach($groups as $group) {
            foreach($group->encounters as $encounter) {
                foreach($group->students as $student) {
                    $encounter->students()->attach($student->id, ['attendance' => Arr::random(['C', 'C', 'C', 'C', 'F', 'J'])]);
                }
            }
        }
    }
}
