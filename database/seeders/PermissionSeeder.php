<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // attach(1) = super admin
        // attach(2) = coordenador paroquial
        // attach(3) = coordenador de comunidade
        // attach(4) = secretário
        // attach(5) = catequista

        Permission::create(['name' => 'communities_show', 'label' => 'Ver comunidades'])->roles()->attach([2]);
        Permission::create(['name' => 'community_edit', 'label' => 'Editar comunidade'])->roles()->attach([2,3]);

        Permission::create(['name' => 'user_read', 'label' => 'Ver usuários'])->roles()->attach([2,3]);
        Permission::create(['name' => 'user_edit', 'label' => 'Editar usuários'])->roles()->attach([2,3]);
        Permission::create(['name' => 'user_create', 'label' => 'Cadastrar usuário'])->roles()->attach([2,3]);

        Permission::create(['name' => 'grade_edit', 'label' => 'Gerenciar etapas'])->roles()->attach([2]);
        Permission::create(['name' => 'group_create', 'label' => 'Criar grupos'])->roles()->attach([3]);
        Permission::create(['name' => 'group_edit', 'label' => 'Editar grupos'])->roles()->attach([2,3]);
        Permission::create(['name' => 'attendance_edit', 'label' => 'Alterar frequência'])->roles()->attach([2,3]);

        Permission::create(['name' => 'student_create', 'label' => 'Cadastrar catequizando'])->roles()->attach([2,3]);
        Permission::create(['name' => 'student_edit', 'label' => 'Editar catequizando'])->roles()->attach([2,3,4]);

        Permission::create(['name' => 'catechist_create', 'label' => 'Cadastrar catequistas'])->roles()->attach([2,3]);
        Permission::create(['name' => 'catechist_read', 'label' => 'Ver catequistas'])->roles()->attach([2,3,4,5]);
        Permission::create(['name' => 'catechist_edit', 'label' => 'Editar catequistas'])->roles()->attach([2,3]);

        Permission::create(['name' => 'theme_edit', 'label' => 'Editar temas'])->roles()->attach([2]);
    }
}
