<?php

namespace Database\Seeders;

use App\Models\Parish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parish::create([
            'name' => 'Paróquia São Marcos',
            'tenancy_type' => 'multi',
        ]);
        Parish::create([
            'name' => 'Paróquia São João Batista',
            'tenancy_type' => 'multi',
        ]);
        Parish::create([
            'name' => 'Paróquia São Jorge',
            'tenancy_type' => 'single',
        ]);
    }
}
