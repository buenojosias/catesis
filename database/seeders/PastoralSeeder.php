<?php

namespace Database\Seeders;

use App\Models\Kinship;
use App\Models\Pastoral;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PastoralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastoral::query()->truncate(); DB::table('pastorables')->truncate(); // return;

        $students = Student::all();
        $psmStudents = $students->where('community_id', 1)->pluck('id')->toArray();
        $bgcStudents = $students->where('community_id', 2)->pluck('id')->toArray();
        $nsmStudents = $students->where('community_id', 3)->pluck('id')->toArray();
        $nspStudents = $students->where('community_id', 4)->pluck('id')->toArray();

        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 1, 'name' => 'Pastoral da Criança', 'coordinator' => null])->students()->sync(Arr::random($psmStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 1, 'name' => 'Infância e Adolescência Missionária', 'coordinator' => 'Álvaro César'])->students()->sync(Arr::random($psmStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 1, 'name' => 'Pastoral do Empreendedor', 'coordinator' => 'João Carlos']);
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 1, 'name' => 'Coral Doce Canto', 'coordinator' => 'Josias Bueno'])->students()->sync(Arr::random($psmStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 1, 'name' => 'Coroinhas e Acólitos', 'coordinator' => 'Felipe Wosch'])->students()->sync(Arr::random($psmStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 1, 'name' => 'MESCs', 'coordinator' => null]);
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 2, 'name' => 'Grupo de Jovens', 'coordinator' => 'Fabiano Brito'])->students()->sync(Arr::random($bgcStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 2, 'name' => 'Grupo Familiar', 'coordinator' => 'Fabiano Brito'])->students()->sync(Arr::random($bgcStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 2, 'name' => 'Coroinhas', 'coordinator' => null])->students()->sync(Arr::random($bgcStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 2, 'name' => 'MESCs', 'coordinator' => null]);
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 3, 'name' => 'Apostolado da Oração', 'coordinator' => null]);
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 3, 'name' => 'Grupo de Cantos', 'coordinator' => 'Josias e João Luiz'])->students()->sync(Arr::random($nsmStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 3, 'name' => 'MESCs', 'coordinator' => null]);
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 4, 'name' => 'Grupo de Cantos', 'coordinator' => 'Marquinhos e Solange'])->students()->sync(Arr::random($nspStudents, rand(1,10)));
        Pastoral::create(['user_id' => rand(1,13), 'community_id' => 4, 'name' => 'Legião de Maria', 'coordinator' => null]);

        $kinships = Kinship::all();
        $kinships = $kinships->pluck('id')->toArray();
        $pastorals = Pastoral::whereDoesntHave('students')->get();
        foreach($pastorals as $pastoral) {
            $pastoral->kinships()->sync(Arr::random($kinships, rand(1, 10)));
        }
   }
}
