<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Parish;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('group_student')->truncate();
        // DB::table('encounter_student')->truncate();
        // DB::table('student_profiles')->truncate();
        // Student::query()->truncate();

        $communities = Community::all();
        $parishes = Parish::whereDoesntHave('communities')->get();

        foreach($communities as $community) {
            Student::factory(rand(20,60))->hasAddress()->hasProfile()->create([
                'parish_id' => $community->parish_id,
                'community_id' => $community->id,
            ]);
        }

        foreach($parishes as $parish) {
            Student::factory(rand(20,60))->hasAddress()->hasProfile()->create([
                'parish_id' => $parish->id,
            ]);
        }
    }
}
