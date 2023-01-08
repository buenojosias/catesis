<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Matriculation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatriculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Matriculation::query()->truncate();
        $students = Student::whereHas('kinships')->get();
        foreach($students as $student) {
            $year = 2023;
            $group = $student->community->groups()->where('grade_id', $student->grade_id)->where('year', $year)->orderByRaw('RAND()')->first();
            $user = $student->community->users()->orderByRaw('RAND()')->first();
            $kinship = $student->kinships()->orderByRaw('RAND()')->first();
            if($group) {
                $matriculation = Matriculation::create([
                    'user_id' => $user->id,
                    'community_id' => $student->community_id,
                    'student_id' => $student->id,
                    'kinship_id' => $kinship->id,
                    'year' => $year
                ]);
                $student->groups()->attach($group->id, [
                    'matriculation_id' => $matriculation->id,
                ]);
            }
        }
    }
}
