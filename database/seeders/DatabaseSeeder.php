<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CommunitySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        \App\Models\User::create([
            'name' => 'Josias Bueno',
            'email' => 'josias@catesis.com',
            'password' => bcrypt('12345678')
        ])->roles()->attach(1);
        
        // \App\Models\User::factory(10)->create();


    }
}
