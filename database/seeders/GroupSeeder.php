<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); DB::table('group_user')->truncate(); Group::query()->truncate();

        $year = 2023;
        $users = User::all();
        foreach ([1, 2, 3, 4] as $community_id) {
            $catechists = $users->where('community_id', $community_id)->pluck('id')->toArray();
            foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9] as $grade_id) {
                // if($grade_id > 1) {
                    $retroactive_group = Group::create([
                        'community_id' => $community_id,
                        'grade_id' => $grade_id,
                        'year' => $year-1,
                        'weekday' => rand(0, 6),
                        'time' => rand(8, 20).':'.Arr::random(['00','30']).':00',
                        'start_date' => $year-1 . '-03-04',
                        'end_date' => $year-1 . '-12-03',
                        'finished' => true,
                    ]);
                    $retroactive_group->users()->sync(Arr::random($catechists, rand(1,2)));
                // }

                $group = Group::create([
                    'community_id' => $community_id,
                    'grade_id' => $grade_id,
                    'year' => $year,
                    'weekday' => rand(0, 6),
                    'time' => rand(8, 20).':'.Arr::random(['00','30']).':00',
                    'start_date' => $year . '-01-14',
                    'end_date' => $year . '-12-03',
                    'finished' => false,
                ]);
                $group->users()->sync(Arr::random($catechists, rand(1,2)));
            }
        }
    }
}
