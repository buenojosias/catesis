<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Parish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //# ESTÁ TUDO ZOADO
        $communities = Community::with(['students','users'])->get();
        $parishes = Parish::whereDoesntHave('communities')->with(['students','users'])->get();

        foreach ($communities as $community) {
            $users = $community->users->pluck('id');
            $students = $community->students->pluck('id');

            Comment::factory(500)->create([
                'parish_id' => $community->parish_id,
                'community_id' => $community->id,
                'user_id' => $users->random(),
                'student_id' => $students->random(),
            ]);
        }

        foreach ($parishes as $parish) {
            $users = $parish->users->pluck('id')->toArray();
            $students = $parish->students->pluck('id')->toArray();
            Comment::factory(200)->create();
        }
    }
}
