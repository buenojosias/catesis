<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use WireUi\Traits\Actions;

class Others extends Component
{
    use Actions;

    public $student;
    public $status;

    public function mount($student)
    {
        $this->student = $student;
        $this->status = $this->student->status;
    }

    public function changeStatus(): void
    {
        $this->dialog()->confirm([
            'title' => 'Confirma alteração do status?',
            'description' => 'Tem certeza que deseja alterar o status do catequizando '.$this->student->name.' para '.$this->status.'?',
            'method' => 'doChangeStatus',
            'acceptLabel' => 'Confirmar',
            'rejectLabel' => 'Cancelar',
        ]);
    }

    public function doChangeStatus()
    {
        try {
            $this->student->update(['status' => $this->status]);
            $this->changeGroupStatus($this->status);
            $this->notification()->success($description = 'Status alterado com sucesso.');
            $this->dispatchBrowserEvent('close', ['form' => false]);
            $this->student->status = $this->status;
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Erro ao alterar status.');
            dump($th);
        }
    }

    public function changeGroupStatus($newStatus) {
        $currentGroup = $this->student->groups()->where('finished', false)->wherePivot('status', 'Ativo')->first();
        if (!$currentGroup)
            return;
        $newStatusArray = ['Ativo' => 'Ativo', 'Desistente' => 'Removido', 'Transferido' => 'Transferido', 'Crismado' => 'Aprovado'];
        try {
            $this->student->groups()->updateExistingPivot($currentGroup->id, ['status' => $newStatusArray[$newStatus]]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.student.others');
    }
}
