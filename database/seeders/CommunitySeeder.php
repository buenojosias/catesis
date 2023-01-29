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
            'parish_id' => 1,
            'name' => 'Paróquia São Marcos (Matriz)',
        ]);
        Community::create([
            'parish_id' => 1,
            'name' => 'Capela Beato Giácomo Cusmano',
        ]);
        Community::create([
            'parish_id' => 1,
            'name' => 'Capela Nossa Senhora da Misericórdia',
        ]);
        Community::create([
            'parish_id' => 1,
            'name' => 'Capela Nossa Senhora da Perseverança',
        ]);
        Community::create([
            'parish_id' => 2,
            'name' => 'Paróquia São João Batista (Matriz)',
        ]);
        Community::create([
            'parish_id' => 2,
            'name' => 'Capela Nossa Senhora Aparecida',
        ]);
        Community::create([
            'parish_id' => 2,
            'name' => 'Capela Sagrada Família',
        ]);
        Community::create([
            'parish_id' => 2,
            'name' => 'Capela São Sebastião',
        ]);
    }
}
