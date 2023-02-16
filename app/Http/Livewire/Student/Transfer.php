<?php

namespace App\Http\Livewire\Student;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class Transfer extends Component
{
    use Actions;

    public $kinships;
    public $kinship_id;
    public $parish_id;
    public $community_id;
    public $group;
    public $student;

    protected $validationAttributes = [
        'kinship_id' => 'Familiar solicitante',
    ];
    public function submitTransfer() {
        $token = Str::upper(Str::random(5).'-').Str::upper(Str::random(5).'-').Str::upper(Str::random(5).'-').Str::upper(Str::random(5));
        $validKinships = $this->kinships->pluck('id')->toArray();
        $validate = $this->validate([
            'kinship_id' => 'required|in:' . implode(',', $validKinships),
        ]);
        DB::beginTransaction();
        try {
            $transfer = $this->student->transfer()->create([
                'user_id' => auth()->user()->id,
                'kinship_id' => $this->kinship_id,
                'parish_id' => $this->student->parish_id,
                'community_id' => $this->student->community_id,
                'token' => $token,
            ]);
            if($this->group) {
                $update_group = $this->student->groups()->updateExistingPivot($this->group->id, ['status' => 'Transferido']);
            } else {
                $update_group = 1;
            }
            $update_student = $this->student->update(['status' => 'Transferido']);
        } catch (\Throwable $th) {
            dump($th);
        }

        if($transfer && $update_group && $update_student) {
            DB::commit();
            // $this->emit('emitCloseModal');
            // $this->dialog(['description'=>'Transferência gerada com sucesso.','icon'=>'success']);
            return redirect()->route('students.show', [$this->student, 'outros'])->with('success','Transferência gerada com sucesso.');
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao gerar transferência.','icon'=>'error']);
        }
    }

    public function mount($student)
    {
        $this->student = $student;
        $this->group = $this->student->groups()->wherePivot('status', 'Ativo')->with('grade')->first();
    }

    public function render()
    {
        dump($this->student);
        $this->kinships = $this->student->kinships;
        return view('livewire.student.transfer');
    }
}
