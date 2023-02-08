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
        foreach(['Pai','Mãe','Avô','Avó','Tio','Tia','Padrasto','Madrasta','Padrinho','Madrinha','Irmão','Irmã','Primo','Prima'] as $title){
            kinshipTitle::create([
                'title' => $title
            ]);
        }
    }
}
