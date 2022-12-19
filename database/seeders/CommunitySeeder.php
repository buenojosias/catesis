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
        ]);
        Community::create([
            'name' => 'Capela Beato Giácomo Cusmano',
        ]);
        Community::create([
            'name' => 'Capela Nossa Senhora da Misericórdia',
        ]);
        Community::create([
            'name' => 'Capela Nossa Senhora da Perseverança',
        ]);
    }
}
