<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = User::where('id', '<', 26)->get();
        // foreach ($users as $user) {
        //     UserProfile::factory(1)->create(['user_id' => $user->id]);
        // }
    }
}
