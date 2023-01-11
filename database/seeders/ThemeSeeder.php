<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = Grade::all();
        foreach($grades as $grade) {
            Theme::factory(8)->create([
                'grade_id' => $grade->id,
            ]);
        }
    }
}
