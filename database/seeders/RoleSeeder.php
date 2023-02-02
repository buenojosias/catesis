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
        Role::create(['name' => 'super-admin', 'label' => 'Administrador Master']);
        Role::create(['name' => 'admin', 'label' => 'Coordenador(a) paroquial']);
        Role::create(['name' => 'coordinator', 'label' => 'Coordenador(a)']);
        Role::create(['name' => 'secretary', 'label' => 'Secretário(a)']);
        Role::create(['name' => 'catechist', 'label' => 'Catequista']);
    }
}
