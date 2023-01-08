<?php

namespace Database\Seeders;

use App\Models\Kinship;
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
        Kinship::factory(300)->hasProfile()->create();

        foreach(Kinship::all() as $kinship) {
            $kinship->students()->attach([rand(1,200)], [
                'kinship_title_id' => rand(1,5),
                'is_enroller' => rand(0,1),
                'live_together' => rand(0,1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
