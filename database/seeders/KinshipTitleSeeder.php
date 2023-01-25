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
        foreach(['Pai','Mãe','Tio','Tia','Padrinho','Madrinha','Avô','Avó','Padrasto','Madrasta','Irmão','Irmã','Primo','Prima'] as $title){
            kinshipTitle::create([
                'title' => $title
            ]);
        }
    }
}
