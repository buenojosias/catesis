<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Matriculation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MatriculationSeeder extends Seeder
{
    public function run()
    {
        // Matriculation::query()->truncate(); DB::table('group_student')->truncate(); return;

        $students = Student::whereHas('kinships')->get();
        $year = 2023;
        foreach($students as $student) {
            $group = $student->community->groups()->where('grade_id', $student->grade_id)->where('year', $year)->orderByRaw('RAND()')->first();
            $user = $student->community->users()->orderByRaw('RAND()')->first();
            $kinship = $student->kinships()->orderByRaw('RAND()')->first();
            if($group) {
                if($student->grade_id > 1) {
                    $retroactive_group = $student->community->groups()->where('grade_id', $student->grade_id-1)->where('year', $year-1)->orderByRaw('RAND()')->first();
                    $retroactive_matriculation = Matriculation::create([
                        'user_id' => $user->id,
                        'community_id' => $student->community_id,
                        'student_id' => $student->id,
                        'kinship_id' => $kinship->id,
                        'year' => $year-1
                    ]);
                    $student->groups()->attach($retroactive_group->id, [
                        'matriculation_id' => $retroactive_matriculation->id,
                        'status' => Arr::random(['approved','approved','approved','approved','approved','transferred','reproved','removed']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $matriculation = Matriculation::create([
                    'user_id' => $user->id,
                    'community_id' => $student->community_id,
                    'student_id' => $student->id,
                    'kinship_id' => $kinship->id,
                    'year' => $year
                ]);
                $student->groups()->attach($group->id, [
                    'matriculation_id' => $matriculation->id,
                    'status' => Arr::random(['in_progress','in_progress','in_progress','in_progress','in_progress','transferred','removed']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
