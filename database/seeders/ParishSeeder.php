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
        # PRODUÇÃO
        /*$psm = Parish::create(['name' => 'Paróquia São Marcos', 'tenancy_type' => 'multi']);
            $psm->detail()->create(['parson' => 'Pe. Mauro Zandoná', 'address' => 'Rua Roberto Gava, 310', 'district' => 'Pilarzinho', 'zip_code' => '82120-500', 'city' => 'Curitiba']);
            $psm->contact()->create(['phone' => '(41) 3338-4450', 'email' => 'saomarcos@mitradecuritiba.org.br', 'facebook' => 'https://www.facebook.com/paroquiasaomarcoscuritiba']);*/
        # FIM PRODUÇÃO

        # SANDBOX
        $par = Parish::create(['name' => 'Paróquia de Demonstração', 'tenancy_type' => 'multi']);
            $par->detail()->create(['parson' => 'Padre John Doe', 'address' => 'Rua Dom Pedro, 123', 'district' => 'Pilarzinho', 'zip_code' => '00000-000', 'city' => 'Curitiba']);
            $par->contact()->create(['phone' => '(33) 3333-3333', 'email' => 'paroquia1@catesis.com']);
        # FIM SANDBOX

        # TESTES DESENVOLVIMENTO
        /*$par1 = Parish::create(['name' => 'Paróquia 1', 'tenancy_type' => 'multi']);
            $par1->detail()->create(['parson' => 'Padre John Doe', 'address' => 'Rua Dom Pedro, 123', 'district' => 'Pilarzinho', 'zip_code' => '00000-000', 'city' => 'Curitiba']);
            $par1->contact()->create(['phone' => '(33) 3333-3333', 'email' => 'paroquia1@catesis.com']);
        $par2 = Parish::create(['name' => 'Paróquia 2', 'tenancy_type' => 'single']);
            $par2->detail()->create(['parson' => 'Padre John Doe', 'address' => 'Rua Dom Pedro, 123', 'district' => 'Pilarzinho', 'zip_code' => '00000-000', 'city' => 'Curitiba']);
            $par2->contact()->create(['phone' => '(33) 3333-3333', 'email' => 'paroquia1@catesis.com']);*/
        # FIM TESTES DESENVOLVIMENTO

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
