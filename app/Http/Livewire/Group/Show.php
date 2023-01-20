<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\Theme;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Show extends Component
{
    use Actions;

    public $group;
    public $catechists;
    public $encounters;
    public $students;
    public $themes;
    public $students_count;
    public $showFormModal;

    public $showEncounterModal;
    public $encounterModalTitle;
    public $method;
    public $edit_encounter;
    public $edit_themes;

    protected $validationAttributes = [
        'edit_encounter.date' => 'Data do encontro',
        'edit_encounter.method' => 'Método',
        'edit_encounter.theme_id' => 'Tema',
    ];

    public function openFormModal() {
        $this->showFormModal = true;
    }

    public function openEncounterModal($method, $encounter = null) {
        $this->method = $method;
        $this->edit_encounter = $encounter;
        if($method === 'create') { $this->edit_encounter['date'] = null; }
        $this->edit_themes = Theme::where('grade_id', $this->group->grade_id)->orderBy('sequence', 'asc')->get();
        $this->showEncounterModal = true;
    }

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->catechists = $group->users;
        $this->students_count = $group->students()->count();
    }

    public function showStudents()
    {
        $this->hideEncounters();
        $this->hideThemes();
        if($this->students)
            return;
        $this->students = $this->group->students()->orderBy('name', 'asc')->get();
        foreach($this->students as $student) {
            $student->age = Carbon::parse($student->birth)->age;
        }
    }

    public function showEncounters()
    {
        $this->hideStudents();
        $this->hideThemes();
        if($this->encounters)
            return;
        $this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
    }

    public function showThemes()
    {
        $this->hideStudents();
        $this->hideEncounters();
        if($this->themes)
            return;
        $this->themes = $this->group->grade->themes()->orderBy('sequence', 'asc')->get();
    }

    public function hideStudents()
    {
        $this->students = null;
    }

    public function hideEncounters()
    {
        $this->encounters = null;
    }

    public function hideThemes()
    {
        $this->themes = null;
    }

    public function submitEncounter()
    {
        $validThemes = $this->edit_themes->pluck('id')->toArray();
        $validate = $this->validate([
            'edit_encounter.date' => 'required|date',
            'edit_encounter.method' => 'required|string',
            'edit_encounter.theme_id' => 'nullable|integer|in:' . implode(',', $validThemes),
        ]);
        if($this->method === 'create') {
            try {
                $encounter = $this->group->encounters()->create($this->edit_encounter);
                $this->notification()->success($description = 'Encontro salvo com sucesso.');
                //$this->encounters->push($encounter);
                $this->showEncounterModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao salvar encontro.');
            }
        } else if($this->method === 'edit') {
            try {
                $save = $this->group->encounters()->findOrFail($this->edit_encounter['id'])->update($this->edit_encounter);
                $this->notification()->success($description = 'Encontro salvo com sucesso.');
                //$this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
                $this->showEncounterModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao salvar encontro.');
            }
        }
    }

    public function render()
    {
        return view('livewire.group.show');
    }
}
