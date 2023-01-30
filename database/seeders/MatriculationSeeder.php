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
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Matriculation::query()->truncate();
        // DB::table('group_student')->truncate();

        $students = Student::whereHas('kinships')->get();
        $all_groups = Group::all();
        $all_users = User::whereBetween('id', [2, 15])->get();
        $year = 2023;

        foreach($students as $student) {
            if($student->community_id) {
                $groups = $all_groups->where('community_id', $student->community_id)->where('grade_id', $student->grade_id)->where('year', $year)->toArray();
                $users = $all_users->where('community_id', $student->community_id)->toArray();//->orderByRaw('RAND()')->first();
            } else {
                $groups = $all_groups->where('parish_id', $student->parish_id)->where('grade_id', $student->grade_id)->where('year', $year)->toArray();
                $users = $all_users->where('parish_id', $student->parish_id)->toArray();//->orderByRaw('RAND()')->first();
            }
            $group = Arr::random($groups);//->orderByRaw('RAND()')->first();
            $user = Arr::random($users);//->orderByRaw('RAND()')->first();
            $kinship = $student->kinships->first();
            if($group) {
                if($student->grade_id > 1) {
                    if($student->community_id) {
                        $retroactive_groups = $all_groups->where('community_id', $student->community_id)->where('grade_id', $student->grade_id-1)->where('year', $year-1)->toArray();
                    } else {
                        $retroactive_groups = $all_groups->where('parish_id', $student->parish_id)->where('grade_id', $student->grade_id-1)->where('year', $year-1)->toArray();
                    }
                    $retroactive_group = Arr::random($retroactive_groups);
                    $retroactive_matriculation = Matriculation::create([
                        'parish_id' => $student->parish_id,
                        'community_id' => $student->community_id ?? null,
                        'user_id' => $user['id'],
                        'student_id' => $student['id'],
                        'kinship_id' => $kinship['id'],
                        'year' => $year-1
                    ]);
                    $student->groups()->attach($retroactive_group['id'], [
                        'matriculation_id' => $retroactive_matriculation->id,
                        'status' => Arr::random(['Aprovado','Aprovado','Aprovado','Aprovado','Aprovado','Transferido','Reprovado','Removido']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                $current_matriculation = Matriculation::create([
                    'parish_id' => $student->parish_id,
                    'community_id' => $student->community_id ?? null,
                    'user_id' => $user['id'],
                    'student_id' => $student['id'],
                    'kinship_id' => $kinship['id'],
                    'year' => $year
                ]);
                $student->groups()->attach($group['id'], [
                    'matriculation_id' => $current_matriculation->id,
                    'status' => Arr::random(['Ativo','Ativo','Ativo','Ativo','Ativo','Transferido','Removido']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
