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
            ParishSeeder::class,
            CommunitySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            UserProfileSeeder::class,
            GradeSeeder::class,
            ThemeSeeder::class,
            GroupSeeder::class,
            StudentSeeder::class,
            KinshipTitleSeeder::class,
            KinshipSeeder::class,
            ContactSeeder::class,
            MatriculationSeeder::class,
            EncounterSeeder::class,
            CommentSeeder::class,
            PastoralSeeder::class,
            // EventSeeder::class,
        ]);
    }
}
