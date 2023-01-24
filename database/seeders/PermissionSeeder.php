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
        // attach(1) = coordenador paroquial
        // attach(2) = coordenador de comunidade
        // attach(3) = secretário
        // attach(4) = catequista

        Permission::create(['name' => 'community_show', 'label' => 'Exibir comunidades'])->roles()->attach([1,2,3]);
        Permission::create(['name' => 'community_edit', 'label' => 'Editar comunidades'])->roles()->attach([1]);

        Permission::create(['name' => 'user_read', 'label' => 'Ver usuários'])->roles()->attach([1,2]);
        Permission::create(['name' => 'user_edit', 'label' => 'Editar usuários'])->roles()->attach([1,2]);
        Permission::create(['name' => 'user_create', 'label' => 'Cadastrar usuário'])->roles()->attach([1,2]);

        Permission::create(['name' => 'grade_edit', 'label' => 'Gerenciar etapas'])->roles()->attach([1]);
        Permission::create(['name' => 'group_create', 'label' => 'Criar grupos'])->roles()->attach([2]);
        Permission::create(['name' => 'group_edit', 'label' => 'Editar grupos'])->roles()->attach([1,2]);
        Permission::create(['name' => 'attendance_edit', 'label' => 'Alterar frequência'])->roles()->attach([1,2]);

        Permission::create(['name' => 'student_create', 'label' => 'Cadastrar catequizando'])->roles()->attach([2,3]);
        Permission::create(['name' => 'student_edit', 'label' => 'Editar catequizando'])->roles()->attach([1,2,3]);

        Permission::create(['name' => 'catechist_create', 'label' => 'Cadastrar catequistas'])->roles()->attach([1,2]);
        Permission::create(['name' => 'catechist_read', 'label' => 'Ver catequistas'])->roles()->attach([1,2,3,4]);
        Permission::create(['name' => 'catechist_edit', 'label' => 'Editar catequistas'])->roles()->attach([1,2]);

        Permission::create(['name' => 'theme_edit', 'label' => 'Editar temas'])->roles()->attach([1]);
    }
}
