<?php

namespace App\Http\Livewire\Group;

use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Finish extends Component
{
    use Actions;

    public $group;
    public $end_date;
    public $students;
    public $selectedSituation = [];

    public function mount($group)
    {
        $this->group = $group;
        $this->end_date = $group->end_date ? Carbon::parse($group->end_date)->format('Y-m-d') : null;
        $this->students = $group->students()->wherePivot('status', 'Ativo')->get();
    }

    protected $validationAttributes = [
        'end_date' => 'Data de encerramento',
    ];

    public function submitSituation()
    {
        $this->validate([
            'end_date' => 'required|date|after:start_date',
        ]);

        foreach ($this->selectedSituation as $key => $selected) {
            $this->selectedSituation['student_id'] = $key;
            $this->selectedSituation['status'] = $selected;
            $student_id = $key;
            $status = $selected;
            $this->group->students()->updateExistingPivot($student_id, ['status' => $status]);
        }
        $this->group->update(['finished' => true, 'end_date' => $this->end_date]);
        $this->notification()->success($description = 'Grupo concluído com sucesso.');
        $this->resetSituation();
        $this->emit('emitCloseFinish', $this->group);
        // return redirect()->route('groups.show', [$this->group])->with('success', 'Grupo concluído com sucesso.');
    }

    public function cancel() {
        $this->resetSituation();
        $this->emit('emitCloseFinish');
    }

    public function resetSituation()
    {
        $this->selectedSituation = [];
    }

    public function render()
    {
        return view('livewire.group.finish');
    }
}
