<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::query()->orderByRaw('RAND()')->limit(40)->get();

        foreach($users as $user) {
            Event::factory(rand(1,3))->create([
                'parish_id' => $user->parish_id,
                'user_id' => $user->id,
            ]);
        }
    }
}
