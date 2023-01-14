<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create(['title' => 'Catequese Infantil']);
        Grade::create(['title' => 'Etapa diferenciada']);
        Grade::create(['title' => '1ª Etapa']);
        Grade::create(['title' => '2ª Etapa']);
        Grade::create(['title' => '3ª Etapa (Eucaristia)']);
        Grade::create(['title' => '4ª Etapa']);
        Grade::create(['title' => '5ª Etapa']);
        Grade::create(['title' => '5ª Etapa (Crisma)']);
    }
}
