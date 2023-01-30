<?php

namespace Database\Seeders;

use App\Models\Kinship;
use App\Models\KinshipTitle;
use App\Models\Parish;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class KinshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('kinship_student')->truncate();
        // Kinship::query()->truncate();

        $parishes = Parish::withCount('students')->get();
        $titles = KinshipTitle::pluck('title');

        foreach ($parishes as $parish) {
            Kinship::factory($parish->students_count * 2)->hasProfile()->create([
                'parish_id' => $parish->id,
            ]);
            $students = Student::where('parish_id', $parish->id)->get();
            $kinships = Kinship::where('parish_id', $parish->id)->get()->pluck('id')->toArray();
            foreach ($students as $student) {
                $student->kinships()->attach(Arr::random($kinships), [
                    'title' => $titles->random(),
                    'is_enroller' => 1,
                    'lives_together' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $student->kinships()->attach(Arr::random($kinships), [
                    'title' => $titles->random(),
                    'is_enroller' => 0,
                    'lives_together' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

}
