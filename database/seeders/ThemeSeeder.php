<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Parish;
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
        $parishes = Parish::all();
        foreach($parishes as $parish) {
            foreach($grades as $grade) {
                Theme::factory(8)->create([
                    'parish_id' => $parish->id,
                    'grade_id' => $grade->id,
                ]);
            }
        }
    }
}
