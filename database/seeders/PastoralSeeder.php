<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Kinship;
use App\Models\Parish;
use App\Models\Pastoral;
use App\Models\Student;
use App\Models\User;
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
        // Pastoral::query()->truncate();
        // DB::table('pastorables')->truncate();

        $parish_id = 1;

        $students = Student::where('parish_id', $parish_id)->get()->pluck('id')->toArray();
        $users = User::where('parish_id', $parish_id)->get()->pluck('id')->toArray();
        $pastorals = [
            'Grupo de Jovens',
            'Pastoral Familiar',
            'Legião de Maria',
            'Pastoral da Música',
            'Pastoral da Liturgia',
            'Terço dos Homens',
        ];

        for($i = 0; $i <= 5; $i++) {
            Pastoral::create(['user_id' => Arr::random($users), 'parish_id' => $parish_id, 'community_id' => 1, 'name' => $pastorals[$i], 'coordinator' => null])->students()->sync(Arr::random($students, rand(1,4)));
        }

        $kinships = Kinship::where('parish_id', $parish_id);
        $kinships = $kinships->pluck('id')->toArray();
        foreach(Pastoral::where('parish_id', $parish_id)->whereDoesntHave('students')->get() as $pastoral) {
            $pastoral->kinships()->sync(Arr::random($kinships, rand(1, 4)));
        }
   }
}
