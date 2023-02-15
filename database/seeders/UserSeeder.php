<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Parish;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('model_has_roles')->truncate();
        // DB::table('user_profiles')->truncate();
        // User::query()->truncate();

        # PRODUÇÃO
        /*$superadmin = User::create(['name' => 'Administrador Master', 'email' => 'admin@catesis.com.br', 'password' => bcrypt('JPB@2019'), 'remember_token' => Str::random(10)])->assignRole('super-admin');
            $superadmin->profile()->create(['birthday' => '1988-03-09', 'marital_status' => 'Solteiro(a)']);
            $superadmin->contact()->create(['whatsapp' => '(41) 99688-1818']);
        $coord_par = User::create(['parish_id' => 1, 'name' => 'Coordenadora Paroquial São Marcos', 'email' => 'admin@psmarcos.org.br', 'password' => bcrypt('Ritinha@123'), 'remember_token' => Str::random(10)])->assignRole('admin');
            $coord_par->profile()->create(['birthday' => '1986-05-10', 'marital_status' => 'Casado(a)']);
            $coord_par->contact()->create(['whatsapp' => '(41) 99601-7057']);*/
        # FIM PRODUÇÃO

        # SANDBOX
        $super_admin = User::create(['name' => 'Super Admin', 'email' => 'superadmin@sandbox.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('super-admin');
            $super_admin->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $super_admin->contact()->create(['phone' => '(99) 99999-9999']);
        $coord_par = User::create(['parish_id' => 1, 'name' => 'Coordenador Paroquial', 'email' => 'admin@sandbox.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('admin');
            $coord_par->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $coord_par->contact()->create(['phone' => '(99) 99999-9999']);
        $coord_com = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Coordenador de Comunidade', 'email' => 'coordenador@sandbox.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('coordinator');
            $coord_com->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Casado(a)']);
            $coord_com->contact()->create(['phone' => '(99) 99999-9999']);
        $sec = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Secretário de Comunidade', 'email' => 'secretario@sandbox.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('secretary');
            $sec->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $sec->contact()->create(['phone' => '(99) 99999-9999']);
        $cat1 = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Catequista 1', 'email' => 'catequista1@sandbox.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat1->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat1->contact()->create(['phone' => '(99) 99999-9999']);
        $cat2 = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Catequista 2', 'email' => 'catequista2@sandbox.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat2->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat2->contact()->create(['phone' => '(99) 99999-9999']);
        # FIM SANDBOX

        # TESTES DESENVOLVIMENTO
        /*$super_admin = User::create(['name' => 'Super Admin', 'email' => 'superadmin@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('super-admin');
            $super_admin->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $super_admin->contact()->create(['phone' => '(99) 99999-9999']);
        $coord_par1 = User::create(['parish_id' => 1, 'name' => 'Coordenador da Paróquia 1', 'email' => 'admin1@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('admin');
            $coord_par1->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $coord_par1->contact()->create(['phone' => '(99) 99999-9999']);
        $coord_par2 = User::create(['parish_id' => 2, 'name' => 'Coordenador da Paróquia 2', 'email' => 'admin2@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('admin');
            $coord_par2->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $coord_par2->contact()->create(['phone' => '(99) 99999-9999']);
        $coord_com1 = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Coordenador da Comunidade 1', 'email' => 'coordenador1@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('coordinator');
            $coord_com1->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Casado(a)']);
            $coord_com1->contact()->create(['phone' => '(99) 99999-9999']);
        $coord_com2 = User::create(['parish_id' => 1, 'community_id' => 2, 'name' => 'Coordenador da Comunidade 2', 'email' => 'coordenador2@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('coordinator');
            $coord_com2->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Casado(a)']);
            $coord_com2->contact()->create(['phone' => '(99) 99999-9999']);
        $sec = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Secretário da Comunidade 1', 'email' => 'secretario@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('secretary');
            $sec->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $sec->contact()->create(['phone' => '(99) 99999-9999']);
        $cat1 = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Catequista 1', 'email' => 'catequista1@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat1->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat1->contact()->create(['phone' => '(99) 99999-9999']);
        $cat2 = User::create(['parish_id' => 1, 'community_id' => 1, 'name' => 'Catequista 2', 'email' => 'catequista2@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat2->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat2->contact()->create(['phone' => '(99) 99999-9999']);
        $cat3 = User::create(['parish_id' => 1, 'community_id' => 2, 'name' => 'Catequista 3', 'email' => 'catequista3@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat3->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat3->contact()->create(['phone' => '(99) 99999-9999']);
        $cat4 = User::create(['parish_id' => 1, 'community_id' => 2, 'name' => 'Catequista 4', 'email' => 'catequista4@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat4->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat4->contact()->create(['phone' => '(99) 99999-9999']);
        $cat5 = User::create(['parish_id' => 2, 'name' => 'Catequista 5', 'email' => 'catequista5@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat5->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat5->contact()->create(['phone' => '(99) 99999-9999']);
        $cat6 = User::create(['parish_id' => 2, 'name' => 'Catequista 6', 'email' => 'catequista6@catesis.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)])->assignRole('catechist');
            $cat6->profile()->create(['birthday' => '2000-01-01', 'marital_status' => 'Solteiro(a)']);
            $cat6->contact()->create(['phone' => '(99) 99999-9999']);*/
        # FIM TESTES DESENVOLVIMENTO


        // User::create([
        //     'parish_id' => 1,
        //     'name' => 'Coordenador Paroquial São João Batista',
        //     'email' => 'admin@sjbatista.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('admin');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 1,
        //     'name' => 'Coordenador da Matriz São Marcos',
        //     'email' => 'coordenador@matriz.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 2,
        //     'name' => 'Coordenador do Beato',
        //     'email' => 'coordenador@beato.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 3,
        //     'name' => 'Coordenador da Misericórdia',
        //     'email' => 'coordenador@misericordia.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 4,
        //     'name' => 'Coordenador da Perseverança',
        //     'email' => 'coordenador@perseveranca.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');

        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 5,
        //     'name' => 'Coordenador da Matriz São João',
        //     'email' => 'coordenador@saojoao.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 6,
        //     'name' => 'Coordenador da Aparecida',
        //     'email' => 'coordenador@aparecida.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 7,
        //     'name' => 'Coordenador da Sagrada Família',
        //     'email' => 'coordenador@famila.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 8,
        //     'name' => 'Coordenador da São Sebastião',
        //     'email' => 'coordenador@sebastiao.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');
        // User::create([
        //     'parish_id' => 3,
        //     'name' => 'Coordenador da Paróquia São Jorge',
        //     'email' => 'coordenador@jorge.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('coordinator');

        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 1,
        //     'name' => 'Secretária da Matriz',
        //     'email' => 'secretaria@matriz.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('secretary');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 2,
        //     'name' => 'Secretária do Beato',
        //     'email' => 'secretaria@beato.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('secretary');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 3,
        //     'name' => 'Secretária da Misericórdia',
        //     'email' => 'secretaria@misericordia.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('secretary');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 4,
        //     'name' => 'Secretária da Perseverança',
        //     'email' => 'secretaria@perseveranca.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('secretary');

        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 1,
        //     'name' => 'Catequista da Matriz',
        //     'email' => 'catequista@matriz.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 2,
        //     'name' => 'Catequista do Beato',
        //     'email' => 'catequista@beato.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 3,
        //     'name' => 'Catequista da Misericórdia',
        //     'email' => 'catequista@misericordia.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 1,
        //     'community_id' => 4,
        //     'name' => 'Catequista da Perseverança',
        //     'email' => 'catequista@perseveranca.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');

        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 5,
        //     'name' => 'Catequista da Matriz São João',
        //     'email' => 'catequista@saojoao.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 6,
        //     'name' => 'Catequista da Aparecida',
        //     'email' => 'catequista@aparecida.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 7,
        //     'name' => 'Catequista da Sagrada Família',
        //     'email' => 'catequista@famila.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 2,
        //     'community_id' => 8,
        //     'name' => 'Catequista da São Sebastião',
        //     'email' => 'catequista@sebastiao.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');
        // User::create([
        //     'parish_id' => 3,
        //     'name' => 'Catequista da São Jorge',
        //     'email' => 'catequista@jorge.com',
        //     'password' => bcrypt('123456'),
        //     'remember_token' => Str::random(10),
        // ])->assignRole('catechist');

        // foreach(Community::all() as $community) {
        //     User::factory(10)->hasProfile()->create([
        //         'parish_id' => $community->parish_id,
        //         'community_id' => $community->id,
        //     ]);
        // }

        // foreach(Parish::whereDoesntHave('communities')->get() as $parish) {
        //     User::factory(12)->hasProfile()->create([
        //         'parish_id' => $parish->id,
        //     ]);
        // }

        // $users = User::where('id', '>', 24)->get();
        // foreach ($users as $user) {
        //     $user->assignRole('catechist');
        // }

    }
}
