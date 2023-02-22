<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->pluck('id')->toArray();

        $titles = [
            'Reuniões da Comunidade',
            'Reuniões da Comissão Bíblica Catequética - Paroquial',
            'Reuniões do Setor',
            'Discípulo Amado I',
            'Discípulo Amado II',
            'ICE',
            'Encontros Paroquiais',
            'Encontros Setoriais',
            'Encontros Arquidiocesanos',
        ];
        if (env('APP_ENV') === 'local') {
            foreach ($titles as $title) {
                Training::create(['title' => $title])->catechists()->sync(Arr::random($users, rand(1, count($users))));
            }
        } else if (env('APP_ENV') === 'production') {
            foreach ($titles as $title) {
                Training::create(['title' => $title]);
            }
        }
    }
}
