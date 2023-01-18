<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Coodenador Paroquial',
            'email' => 'admin@catesis.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(1);
        User::create([
            'community_id' => 1,
            'name' => 'Coodenador da Matriz',
            'email' => 'coordenador@matriz.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'community_id' => 2,
            'name' => 'Coodenador do Beato',
            'email' => 'coordenador@beato.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'community_id' => 3,
            'name' => 'Coodenador da Misericórdia',
            'email' => 'coordenador@misericordia.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'community_id' => 4,
            'name' => 'Coodenador da Perseverança',
            'email' => 'coordenador@perseveranca.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(2);
        User::create([
            'community_id' => 1,
            'name' => 'Secretária da Matriz',
            'email' => 'secretaria@matriz.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'community_id' => 2,
            'name' => 'Secretária do Beato',
            'email' => 'secretaria@beato.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'community_id' => 3,
            'name' => 'Secretária da Misericórdia',
            'email' => 'secretaria@misericordia.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'community_id' => 4,
            'name' => 'Secretária da Perseverança',
            'email' => 'secretaria@perseveranca.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(3);
        User::create([
            'community_id' => 1,
            'name' => 'Catequista da Matriz',
            'email' => 'catequista@matriz.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'community_id' => 2,
            'name' => 'Catequista do Beato',
            'email' => 'catequista@beato.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'community_id' => 3,
            'name' => 'Catequista da Misericórdia',
            'email' => 'catequista@misericordia.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);
        User::create([
            'community_id' => 4,
            'name' => 'Catequista da Perseverança',
            'email' => 'catequista@perseveranca.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ])->roles()->attach(4);

        User::factory(10)->hasProfile()->create([
            'community_id' => rand(1,4)
        ]);

        $users = User::where('id', '>', 13)->get();
        foreach ($users as $user) {
            $user->roles()->attach(4);
        }
    }
}
