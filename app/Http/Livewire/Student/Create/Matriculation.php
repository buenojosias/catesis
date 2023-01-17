<?php

namespace App\Http\Livewire\Student\Create;

use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Matriculation extends Component
{
    use Actions;

    public $student;
    public $comment;
    public $groups;
    public $kinship;
    public $matriculation;
    public $group;

    protected $listeners = [
        'emitKinship'
    ];

    protected $validationAttributes = [
        'group' => 'Grupo',
        'kinship' => 'Familiar responsável',
        'comment' => 'Observações',
    ];

    public function submit()
    {
        $validGroups = $this->groups->pluck('id')->toArray();
        $validate = $this->validate([
            'group' => 'required|in:' . implode(',', $validGroups),
            'kinship' => 'required|integer',
            'comment' => 'nullable|string',
        ]);
        $group = $this->groups->where('id', $this->group)->first();

        DB::beginTransaction();
        try {
            $matriculation = $this->student->matriculations()->create([
                'user_id' => auth()->user()->id,
                'community_id' => $this->student->community_id,
                'kinship_id' => $this->kinship,
                'year' => $group->year,
            ]);
            $this->student->groups()->attach($group->id, [
                'matriculation_id' => $matriculation->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $update_student = $this->student->update([
                'grade_id' => $group->grade_id,
            ]);
            if($this->comment) {
                $this->student->comments()->create([
                    'user_id' => auth()->user()->id,
                    'description' => $this->comment,
                ]);
            }
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao concluir rematrícula.');
            dd($th);
        }
        if($matriculation && $update_student) {
            DB::commit();
            $this->matriculation = $matriculation;
            $this->group = $group;
            // $this->notification()->success($description = 'Matrícula concluída com sucesso.');
            // $this->dispatchBrowserEvent('close', ['form' => false]);
            return redirect()->route('students.show', $this->student)->with('success','Cadastro concluído com sucesso.');
        } else {
            DB::rollback();
            $this->notification()->error($description = 'Ocorreu um erro ao concluir rematrícula.');
        }
    }

    public function mount($student)
    {
        $this->student = $student;
        $this->groups = Group::query()
            ->where('community_id', $student->community_id)
            ->where('finished', false)
            ->with('grade')
            ->get();
    }

    public function render()
    {
        return view('livewire.student.create.matriculation');
    }
}
