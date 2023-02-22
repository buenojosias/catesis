<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Parish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Parish::all() as $parish) {
            $parish->balance()->create(['amount' => 0]);
        }

        foreach(Community::all() as $community) {
            $community->balance()->create(['amount' => 0]);
        }
    }
}
