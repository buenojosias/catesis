<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year = 2023;
        foreach ([1, 2, 3, 4] as $community_id) {
            foreach ([1, 2, 3, 4, 5, 6, 7] as $grade_id) {
                $group = Group::create([
                    'community_id' => $community_id,
                    'grade_id' => $grade_id,
                    'year' => $year,
                    'weekday' => 6,
                    'time' => '15:00:00',
                    'start_date' => $year . '-03-04',
                    'end_date' => $year . '-12-03',
                    'finished' => false,
                ]);
                $user = User::where('community_id', $group->community_id)->orderByRaw('RAND()')->first();
                $group->users()->attach($user->id);
            }
        }
    }
}
