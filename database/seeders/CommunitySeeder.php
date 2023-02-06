<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $community1 = Community::create([
            'parish_id' => 1,
            'name' => 'Paróquia São Marcos (Matriz)',
        ]);
        $community1->detail()->create([
            'parson' => 'Pe. Mauro Zandoná',
            'address' => 'Rua Roberto Gava, 310',
            'district' => 'Pilarzinho',
            'city' => 'Curitiba',
        ]);
        $community1->contact()->create([
            'phone' => '(41) 3338-4450',
            'email' => 'lamenha@mitradecuritiba.org.br',
        ]);

        $community2 = Community::create([
            'parish_id' => 1,
            'name' => 'Capela Beato Giácomo Cusmano',
        ]);
        $community2->detail()->create([
            'address' => 'Rua Victório Gabardo, 325',
            'district' => 'Pilarzinho',
            'city' => 'Curitiba',
        ]);
        $community2->contact()->create([
            'phone' => null,
        ]);

        $community3 = Community::create([
            'parish_id' => 1,
            'name' => 'Capela Nossa Senhora da Misericórdia',
        ]);
        $community3->detail()->create([
            'address' => 'Rua Campo Largo da Piedade, 460',
            'district' => 'Pilarzinho',
            'city' => 'Curitiba',
        ]);
        $community3->contact()->create([
            'phone' => null,
        ]);

        $community4 = Community::create([
            'parish_id' => 1,
            'name' => 'Capela Nossa Senhora da Perseverança',
        ]);
        $community4->detail()->create([
            'address' => 'Alexandre Von Humboldt, 283',
            'district' => 'Pilarzinho',
            'city' => 'Curitiba',
        ]);
        $community4->contact()->create([
            'phone' => null,
        ]);

        $community5 = Community::create([
            'parish_id' => 2,
            'name' => 'Paróquia São João Batista (Matriz)',
        ]);
        $community5->detail()->create([
            'address' => 'Rua Ver. Wadislau Bugalski, 4880',
            'district' => 'Jardim Marize',
            'city' => 'Almirante Tamandaré',
        ]);
        $community5->contact()->create([
            'phone' => '(41) 3657-1144',
            'whatsapp' => '(41) 3657-1144',
        ]);

        $community6 = Community::create([
            'parish_id' => 2,
            'name' => 'Capela Nossa Senhora Aparecida',
        ]);
        $community6->detail()->create([
            'address' => 'Rua Roberto Drechsler, 70',
            'district' => 'Tanguá',
            'city' => 'Almirante Tamandaré',
        ]);
        $community6->contact()->create([
            'phone' => '(41) 3657-1144',
        ]);

        $community7 = Community::create([
            'parish_id' => 2,
            'name' => 'Capela Sagrada Família',
        ]);
        $community7->detail()->create([
            'address' => 'Rua João Gianini',
            'district' => 'Gianini',
            'city' => 'Almirante Tamandaré',
        ]);
        $community7->contact()->create([
            'phone' => null,
        ]);

        $community8 = Community::create([
            'parish_id' => 2,
            'name' => 'Capela São Sebastião',
        ]);
        $community8->detail()->create([
            'address' => 'Rua Leandro Pereira Machado, 37',
            'district' => 'Bonfim',
            'city' => 'Almirante Tamandaré',
        ]);
        $community8->contact()->create([
            'phone' => '(41) 3698-4282',
        ]);

    }
}
