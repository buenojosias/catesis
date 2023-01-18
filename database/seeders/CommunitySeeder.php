<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Community::create([
            'name' => 'Paróquia São Marcos',
            'address' => 'Rua Roberto Gava, 310',
        ]);
        Community::create([
            'name' => 'Capela Beato Giácomo Cusmano',
            'address' => 'Rua Victório Gabardo, 325',
        ]);
        Community::create([
            'name' => 'Capela Nossa Senhora da Misericórdia',
            'address' => 'Rua Campo Largo da Piedade, 460',
        ]);
        Community::create([
            'name' => 'Capela Nossa Senhora da Perseverança',
            'address' => 'R. Alexandre Von Humboldt, 283',
        ]);
    }
}
