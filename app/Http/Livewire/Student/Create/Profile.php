<?php

namespace App\Http\Livewire\Student\Create;

use App\Models\Student;
use Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Profile extends Component
{
    use Actions;

    public $user_id;
    public $student;
    // public $community_id;
    public $name;
    public $birthday;
    public $gender;
    public $genders = ['Masculino','Feminino','Outro'];
    public $naturalness;
    public $has_baptism = false;
    public $baptism_date;
    public $baptism_church;
    public $married_parents = false;
    public $health_problems;
    public $school;

    protected $validationAttributes = [
        'name' => 'Nome',
        'birthday' => 'Data de nascimento',
        'gender' => 'Sexo',
        'naturalness' => 'Naturalidade',
        'has_baptism' => 'É batizado(a)',
        'baptism_date' => 'Data do batismo',
        'baptism_church' => 'Igreja do batismo',
        'married_parents' => 'Os pais são casados',
        'health_problems' => 'Problemas de saúde',
        'school' => 'Escola',
    ];

    public function mount(): void
    {
        $this->user_id = Auth::user()->id;
    }

    public function submit()
    {
        $validateStudent = $this->validate([
            'user_id' => 'required|integer',
            'name' => 'required|string|min:6|max:255',
            'birthday' => 'required|date|before:now',
        ]);
        $validateProfile = $this->validate([
            'gender' => 'required|string',
            'naturalness' => 'nullable|string|max:100',
            'has_baptism' => 'required|boolean',
            'baptism_date' => 'nullable|date|after:birthday|before:now',
            'baptism_church' => 'nullable|string|min:10|max:160',
            'married_parents' => 'required|boolean',
            'health_problems' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:160'
        ]);

        DB::beginTransaction();
        try {
            $student = Student::create($validateStudent);
            $profile = $student->profile()->create($validateProfile);
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao cadastrar catequizando(a).');
            dd($th);
        }
        if($student && $profile) {
            DB::commit();
            $this->student = $student;
            $this->emit('emitStudent', $this->student->id);
            $this->notification()->success($title = 'Catequizando(a) cadastrado(a) com sucesso', $description = 'Continue completando as informações.');
        } else {
            DB::rollback();
            $this->notification()->error($description = 'Ocorreu um erro ao cadastrar catequizando(a).');
        }
    }

    public function render()
    {
        return view('livewire.student.create.profile');
    }
}
