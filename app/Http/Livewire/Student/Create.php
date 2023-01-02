<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public $community_id;
    public $name;
    public $birth;
    public $gender;
    public $genders = ['male','female','other'];
    public $naturalness;
    public $has_baptism = false;
    public $baptism_date;
    public $baptism_church;
    public $married_parents = false;
    public $health_problems;
    public $school;

    protected $validationAttributes = [
        'name' => 'Nome',
        'birth' => 'Data de nascimento',
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
        $this->community_id = Auth::user()->community_id;
    }

    public function submit()
    {
        $validateStudent = $this->validate([
            'community_id' => 'required',
            'name' => 'required|string|min:6|max:255',
            'birth' => 'required|date|before:now',
        ]);
        $validateDatails = $this->validate([
            'gender' => 'required|string',
            'naturalness' => 'nullable|string|max:100',
            'has_baptism' => 'required|boolean',
            'baptism_date' => 'nullable|date|after:birth|before:now',
            'baptism_church' => 'nullable|string|min:10|max:160',
            'married_parents' => 'required|boolean',
            'health_problems' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:160'
        ]);

        DB::beginTransaction();
        try {
            $student = Student::create($validateStudent);
            $detail = $student->detail()->create($validateDatails);
        } catch (\Throwable $th) {
            $this->dialog(['description'=>'Ocorreu um erro ao cadastrar catequizando(a).','icon'=>'error']);
            dd($th);
        }
        if($student && $detail) {
            DB::commit();
            return redirect()->route('students.edit', $student)->with('success','Catequizando(a) cadastrado(a) com sucesso.');
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao cadastrar catequizando(a).','icon'=>'error']);
        }
    }

    public function render()
    {
        return view('livewire.student.create');
    }
}
