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
        KinshipTitle::query()->truncate();

        foreach(['Pai','Mãe','Avô','Avó','Tio','Tia','Pai adotivo','Mãe adotiva','Padrasto','Madrasta','Padrinho','Madrinha','Irmão','Irmã','Primo','Prima'] as $title){
            kinshipTitle::create([
                'title' => $title
            ]);
        }
    }
}
