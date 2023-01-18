<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Kinship;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contact::query()->truncate();

        foreach(Student::all() as $student) {
            Contact::factory(1)->create([
                'contactable_type' => 'App\Models\Student',
                'contactable_id' => $student->id,
            ]);
        }

        foreach(Kinship::all() as $kinship) {
            Contact::factory(1)->create([
                'contactable_type' => 'App\Models\Kinship',
                'contactable_id' => $kinship->id,
            ]);
        }

        foreach(User::all() as $user) {
            Contact::factory(1)->create([
                'contactable_type' => 'App\Models\User',
                'contactable_id' => $user->id,
            ]);
        }
    }
}
