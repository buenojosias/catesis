<?php

namespace Database\Seeders;

use App\Models\KinshipTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KinshipTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['Pai','Mãe','Tio','Tia','Avô','Avó','Irmão','Irmã','Padrinho','Madrinha'] as $title){
            kinshipTitle::create([
                'title' => $title
            ]);
        }
    }
}
