<?php

namespace Database\Seeders;

use App\Models\Parish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parish1 = Parish::create([
            'name' => 'Paróquia São Marcos',
            'tenancy_type' => 'multi',
        ]);
        $parish1->detail()->create([
            'parson' => 'Pe. Mauro Zandoná',
            'address' => 'Rua Roberto Gava, 310',
            'district' => 'Pilarzinho',
            'zip_code' => '82120-500',
            'city' => 'Curitiba',
        ]);
        $parish1->contact()->create([
            'phone' => '(41) 3338-4450',
            'email' => 'saomarcos@mitradecuritiba.org.br',
            'facebook' => 'https://www.facebook.com/paroquiasaomarcoscuritiba',
        ]);

        // $parish2 = Parish::create([
        //     'name' => 'Paróquia São João Batista',
        //     'tenancy_type' => 'multi',
        // ]);
        // $parish2->detail()->create([
        //     'address' => 'Rua Ver. Wadislau Bugalski, 4880',
        //     'district' => 'Jardim Marize',
        //     'city' => 'Almirante Tamandaré',
        // ]);
        // $parish2->contact()->create([
        //     'phone' => '(41) 3657-1144',
        //     'whatsapp' => '(41) 3657-1144',
        //     'email' => 'lamenha@mitradecuritiba.org.br',
        //     'facebook' => 'https://www.facebook.com/paroquiasjbtamandare/',
        // ]);

        // $parish3 = Parish::create([
        //     'name' => 'Paróquia São Jorge',
        //     'tenancy_type' => 'single',
        // ]);
        // $parish3->detail()->create([
        //     'address' => 'Rua Itacolomi, 1840',
        //     'district' => 'Portão',
        //     'city' => 'Curitiba',
        //     'site' => 'http://paroquiasaojorge.com.br/',
        // ]);
        // $parish3->contact()->create([
        //     'phone' => '(41) 3308-3075',
        //     'facebook' => 'https://www.facebook.com/paroquiasaojorgecuritiba',
        // ]);
    }
}
