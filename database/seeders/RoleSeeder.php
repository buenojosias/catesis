<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Coordenador Paroquial']);
        Role::create(['name' => 'Coordenador']);
        Role::create(['name' => 'Secretaria']);
        Role::create(['name' => 'Catequista']);
    }
}
