<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class About extends Component
{
    use Actions;

    public $community;
    public $student;
    public $profile;
    public $group;
    public $catechists;
    public $grade;
    public $name, $birthday;
    public $gender, $naturalness, $has_baptism, $baptism_date, $baptism_church, $married_parents, $health_problems, $school;

    public $showEditProfileModal;
    public $groups;

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

    public function mount(Student $student) {
        $this->student = $student;
        // $this->age = Carbon::parse($student->birthday)->age;
        $this->profile = $student->profile;
        $this->name = $this->student->name;
        $this->birthday = Carbon::parse($this->student->birthday)->format('Y-m-d');
        $this->gender = $this->profile->gender;
        $this->naturalness = $this->profile->naturalness;
        $this->has_baptism = $this->profile->has_baptism;
        if($student->profile->baptism_date) { $this->baptism_date = Carbon::parse($this->profile->baptism_date)->format('Y-m-d'); }
        $this->baptism_church = $this->profile->baptism_church;
        $this->married_parents = $this->profile->married_parents;
        $this->health_problems = $this->profile->health_problems;
        $this->school = $this->profile->school;
        $this->grade = $student->grade;
        $this->group = $this->student->groups()->where('finished', false)->where('year', date('Y'))->first();
        $this->catechists = $this->group->users ?? [];
        if(auth()->user()->hasRole('admin')) {
            $this->community = $student->community;
        }
        // dd($this->baptism_date);
    }

    public function submitProfile()
    {
        $validateStudent = $this->validate([
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
            'school' => 'nullable|string|max:160',
        ]);
        try {
            if($validateProfile['baptism_date'] == "") { $validateProfile['baptism_date'] = null; };
            $saveStudent = $this->student->update($validateStudent);
            $saveProfile = $this->student->profile()->update($validateProfile);
            // $this->student = $validateStudent;
            // $this->profile = $validateProfile;
            $this->notification()->success($description = 'Informações de perfil atualizadas com sucesso.');
            $this->showEditProfileModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar informações.');
            dd($th);
        }
    }

    public function openEditProfileModal()
    {
        $this->showEditProfileModal = true;
    }

    public function render()
    {
        return view('livewire.student.about');
    }
}
