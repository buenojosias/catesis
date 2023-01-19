<?php

namespace App\Http\Livewire\Group;

use App\Models\Grade;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions;

    public $cardTitle;
    public $group;
    public $grade_id;
    public $year;
    public $weekday;
    public $time;
    public $start_date;
    public $end_date;
    public $years = [2023,2022,2021,2020];
    public $grades;

    protected $validationAttributes = [
        'grade_id' => 'Etapa',
        'year' => 'Ano',
        'weekday' => 'Dia dos encontros',
        'time' => 'Horário dos encontros',
        'start_date' => 'Data de início',
        'end_date' => 'Data de encerramento',
    ];

    public function submit()
    {
        $validGrades = $this->grades->pluck('id')->toArray();
        $validYears = $this->years;
        $validate = $this->validate([
            'grade_id' => 'required|integer|in:' . implode(',', $validGrades),
            'year' => 'required|integer|in:' . implode(',', $validYears),
            'weekday' => 'required|integer|min:0|max:7',
            'time' => 'required|date_format:H:i',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);
        $community = auth()->user()->community;

        if(!$this->group) {
            try {
                $group = $community->groups()->create([
                    'grade_id' => $this->grade_id,
                    'year' => $this->year,
                    'weekday' => $this->weekday,
                    'time' => $this->time,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                ]);
                return redirect()->route('groups.show', $group)->with('success','Grupo criado com sucesso.');
            } catch (\Throwable $th) {
                $this->dialog()->error($description = 'Ocorreu um erro criar o grupo.');
                dump($th);
            }
        } else {
            try {
                $this->group->update([
                    'year' => $this->year,
                    'weekday' => $this->weekday,
                    'time' => $this->time,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                ]);
                return redirect()->route('groups.show', $this->group)->with('success','Grupo atualizado com sucesso.');
            } catch (\Throwable $th) {
                $this->dialog()->error($description = 'Ocorrou um erro ao editar o grupo.');
                dump($th);
            }
        }
    }

    public function populateGroup($group)
    {
        $this->grade_id = $group->grade_id;
        $this->year = $group->year;
        $this->weekday = $group->weekday;
        $this->time = $group->time->format('H:i');
        $this->start_date = $group->start_date;
        $this->end_date = $group->end_date;
    }

    public function mount($group = null)
    {
        $this->group = $group;
        $this->year = date('Y');
        $this->cardTitle = $group ? 'Editar grupo' : 'Novo grupo';
        $this->grades = Grade::all();
        if($group) { $this->populateGroup($group); }
    }

    public function render()
    {
        return view('livewire.group.form');
    }
}
