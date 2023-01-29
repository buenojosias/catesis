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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_roles')->truncate();
        DB::table('user_profiles')->truncate();
        User::query()->truncate();

        User::create([
            'parish_id' => 1,
            'name' => 'Coordenador Paroquial São Marcos',
            'email' => 'admin@smarcos.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(1);
        User::create([
            'parish_id' => 2,
            'name' => 'Coordenador Paroquial São João Batista',
            'email' => 'admin@sjbatista.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(1);
        User::create([
            'parish_id' => 3,
            'name' => 'Coordenador Paroquial São Jorge',
            'email' => 'admin@sjorge.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(1);

        User::create([
            'parish_id' => 1,
            'community_id' => 1,
            'name' => 'Coordenador da Matriz São Marcos',
            'email' => 'coordenador@matriz.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'parish_id' => 1,
            'community_id' => 2,
            'name' => 'Coordenador do Beato',
            'email' => 'coordenador@beato.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'parish_id' => 1,
            'community_id' => 3,
            'name' => 'Coordenador da Misericórdia',
            'email' => 'coordenador@misericordia.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'parish_id' => 1,
            'community_id' => 4,
            'name' => 'Coordenador da Perseverança',
            'email' => 'coordenador@perseveranca.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);

        User::create([
            'parish_id' => 2,
            'community_id' => 5,
            'name' => 'Coordenador da Matriz São João',
            'email' => 'coordenador@saojoao.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'parish_id' => 2,
            'community_id' => 6,
            'name' => 'Coordenador da Aparecida',
            'email' => 'coordenador@aparecida.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'parish_id' => 2,
            'community_id' => 7,
            'name' => 'Coordenador da Sagrada Família',
            'email' => 'coordenador@famila.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'parish_id' => 2,
            'community_id' => 8,
            'name' => 'Coordenador da São Sebastião',
            'email' => 'coordenador@sebastiao.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);

        User::create([
            'parish_id' => 1,
            'community_id' => 1,
            'name' => 'Secretária da Matriz',
            'email' => 'secretaria@matriz.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'parish_id' => 1,
            'community_id' => 2,
            'name' => 'Secretária do Beato',
            'email' => 'secretaria@beato.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'parish_id' => 1,
            'community_id' => 3,
            'name' => 'Secretária da Misericórdia',
            'email' => 'secretaria@misericordia.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'parish_id' => 1,
            'community_id' => 4,
            'name' => 'Secretária da Perseverança',
            'email' => 'secretaria@perseveranca.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);

        User::create([
            'parish_id' => 1,
            'community_id' => 1,
            'name' => 'Catequista da Matriz',
            'email' => 'catequista@matriz.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 1,
            'community_id' => 2,
            'name' => 'Catequista do Beato',
            'email' => 'catequista@beato.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 1,
            'community_id' => 3,
            'name' => 'Catequista da Misericórdia',
            'email' => 'catequista@misericordia.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 1,
            'community_id' => 4,
            'name' => 'Catequista da Perseverança',
            'email' => 'catequista@perseveranca.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);

        User::create([
            'parish_id' => 2,
            'community_id' => 5,
            'name' => 'Catequista da Matriz São João',
            'email' => 'catequista@saojoao.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 2,
            'community_id' => 6,
            'name' => 'Catequista da Aparecida',
            'email' => 'catequista@aparecida.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 2,
            'community_id' => 7,
            'name' => 'Catequista da Sagrada Família',
            'email' => 'catequista@famila.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 2,
            'community_id' => 8,
            'name' => 'Catequista da São Sebastião',
            'email' => 'catequista@sebastiao.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'parish_id' => 3,
            'name' => 'Catequista da São Jorge',
            'email' => 'catequista@jorge.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);

        foreach(Community::all() as $community) {
            User::factory(10)->hasProfile()->create([
                'parish_id' => $community->parish_id,
                'community_id' => $community->id,
            ]);
        }

        foreach(Parish::whereDoesntHave('communities')->get() as $parish) {
            User::factory(12)->hasProfile()->create([
                'parish_id' => $parish->id,
            ]);
        }

        $users = User::where('id', '>', 24)->get();
        foreach ($users as $user) {
            $user->roles()->attach(4);
        }
    }
}
