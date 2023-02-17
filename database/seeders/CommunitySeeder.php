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
        # PRODUÇÃO
        if(env('APP_ENV') === 'production') {
            $psm = Community::create(['parish_id' => 1,'name' => 'Paróquia São Marcos (Matriz)']);
                $psm->detail()->create(['parson' => 'Pe. Mauro Zandoná', 'address' => 'Rua Roberto Gava, 310', 'district' => 'Pilarzinho', 'zip_code' => '82120-500', 'city' => 'Curitiba']);
                $psm->contact()->create(['phone' => '(41) 3338-4450']);
            $bgc = Community::create(['parish_id' => 1, 'name' => 'Capela Beato Giácomo Cusmano']);
                $bgc->detail()->create(['address' => 'Rua Victório Gabardo, 325', 'district' => 'Pilarzinho', 'zip_code' => '82115-130', 'city' => 'Curitiba']);
                $bgc->contact()->create(['phone' => null]);
            $nsm = Community::create(['parish_id' => 1, 'name' => 'Capela Nossa Senhora da Misericórdia']);
                $nsm->detail()->create(['address' => 'Rua Campo Largo da Piedade, 460', 'district' => 'Pilarzinho', 'zip_code' => '82110-160', 'city' => 'Curitiba']);
                $nsm->contact()->create(['phone' => null]);
            $nsp = Community::create(['parish_id' => 1,'name' => 'Capela Nossa Senhora da Perseverança']);
                $nsp->detail()->create(['address' => 'Alexandre Von Humboldt, 283', 'district' => 'Pilarzinho', 'zip_code' => '82110-000', 'city' => 'Curitiba']);
                $nsp->contact()->create(['phone' => null]);
        }
        # FIM PRODUÇÃO

        # DESENVOLVIMENTO/SANDBOX
        else if(env('APP_ENV') === 'local') {
            $com1 = Community::create(['parish_id' => 1, 'name' => 'Comunidade 1']);
                $com1->detail()->create(['address' => 'Rua Rainha Elizabeth, 123', 'district' => 'Pilarzinho', 'zip_code' => '80000-000', 'city' => 'Curitiba']);
                $com1->contact()->create(['phone' => null]);
            $com2 = Community::create(['parish_id' => 1,'name' => 'Comunidade 2']);
                $com2->detail()->create(['address' => 'Rua Dom Pedro, 123', 'district' => 'Pilarzinho', 'zip_code' => '80000-000', 'city' => 'Curitiba']);
                $com2->contact()->create(['phone' => null]);
        }
        # FIM DESENVOLVIMENTO/SANDBOX


        // $community5 = Community::create([
        //     'parish_id' => 2,
        //     'name' => 'Paróquia São João Batista (Matriz)',
        // ]);
        // $community5->detail()->create([
        //     'address' => 'Rua Ver. Wadislau Bugalski, 4880',
        //     'district' => 'Jardim Marize',
        //     'city' => 'Almirante Tamandaré',
        // ]);
        // $community5->contact()->create([
        //     'phone' => '(41) 3657-1144',
        //     'whatsapp' => '(41) 3657-1144',
        // ]);

        // $community6 = Community::create([
        //     'parish_id' => 2,
        //     'name' => 'Capela Nossa Senhora Aparecida',
        // ]);
        // $community6->detail()->create([
        //     'address' => 'Rua Roberto Drechsler, 70',
        //     'district' => 'Tanguá',
        //     'city' => 'Almirante Tamandaré',
        // ]);
        // $community6->contact()->create([
        //     'phone' => '(41) 3657-1144',
        // ]);

        // $community7 = Community::create([
        //     'parish_id' => 2,
        //     'name' => 'Capela Sagrada Família',
        // ]);
        // $community7->detail()->create([
        //     'address' => 'Rua João Gianini',
        //     'district' => 'Gianini',
        //     'city' => 'Almirante Tamandaré',
        // ]);
        // $community7->contact()->create([
        //     'phone' => null,
        // ]);

        // $community8 = Community::create([
        //     'parish_id' => 2,
        //     'name' => 'Capela São Sebastião',
        // ]);
        // $community8->detail()->create([
        //     'address' => 'Rua Leandro Pereira Machado, 37',
        //     'district' => 'Bonfim',
        //     'city' => 'Almirante Tamandaré',
        // ]);
        // $community8->contact()->create([
        //     'phone' => '(41) 3698-4282',
        // ]);
    }
}
