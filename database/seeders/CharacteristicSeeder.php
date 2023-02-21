<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CharacteristicSeeder extends Seeder
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
            'Receptivo a todos',
            'Pessoa de alegria, firmeza e esperança',
            'Pessoa de confiança e responsabilidade',
            'Sensível para escutar, conforme as necessidades dos catequizandos',
            'Paciente em respeitar as diferenças individuais dos catequizandos',
            'Tem espírito de superação, otimismo e constância',
            'Pessoa que aceita os próprios acertos e erros',
            'Aberto a sugestões e críticas',
            'Atitude de serviço, não procurando lugar de destaque',
            'Unificador: ponto de união e de comunhão',
        ];

        foreach ($titles as $title) {
            Characteristic::create(['title' => $title])->catechists()->sync(Arr::random($users, rand(4,10)));
        }
    }
}
