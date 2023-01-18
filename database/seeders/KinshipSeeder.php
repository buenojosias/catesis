<?php

namespace Database\Seeders;

use App\Models\Kinship;
use App\Models\KinshipTitle;
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

        foreach(Kinship::all() as $kinship) {
            $kinship->students()->attach([rand(1,200)], [
                'title' => $titles->random(),
                'is_enroller' => rand(0,1),
                'live_together' => rand(0,1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
