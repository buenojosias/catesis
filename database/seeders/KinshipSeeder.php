<?php

namespace Database\Seeders;

use App\Models\Kinship;
use App\Models\KinshipTitle;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KinshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kinship::factory(400)->hasProfile()->create();
        $titles = KinshipTitle::pluck('title');

        foreach(Student::all() as $student) {
            $student->kinships()->attach([rand(1,400)], [
                'title' => $titles->random(),
                'is_enroller' => 1,
                'lives_together' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $student->kinships()->attach([rand(1,400)], [
                'title' => $titles->random(),
                'is_enroller' => 0,
                'lives_together' => rand(0,1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
