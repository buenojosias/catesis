<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;
use WireUi\Traits\Actions;

class Finish extends Component
{
    use Actions;

    public $group;
    public $students;
    public $selectedSituation = [];

    public function mount($group)
    {
        $this->group = $group;
        $this->students = $group->students()->wherePivot('status', 'Ativo')->get();
    }

    public function submitSituation()
    {
        foreach ($this->selectedSituation as $key => $selected) {
            $this->selectedSituation['student_id'] = $key;
            $this->selectedSituation['status'] = $selected;
            $student_id = $key;
            $status = $selected;
            $this->group->students()->updateExistingPivot($student_id, ['status' => $status]);
        }
        $this->group->update(['finished' => true]);
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
