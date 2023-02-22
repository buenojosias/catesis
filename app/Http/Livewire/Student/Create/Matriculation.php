<?php

namespace App\Http\Livewire\Student\Create;

use App\Models\Group;
use App\Models\Movementation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Matriculation extends Component
{
    use Actions;

    public $student;
    public $comment;
    public $groups;
    public $group;
    public $kinship;
    public $matriculation;
    public $payment;

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
                'kinship_id' => $this->kinship,
                'year' => $group->year,
            ]);
            $this->student->groups()->attach($group->id, [
                'matriculation_id' => $matriculation->id,
                'status' => 'Ativo',
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
            if($this->payment && $this->payment != '') {
                $this->registerPayment($matriculation);
            }
            return redirect()->route('students.show', $this->student)->with('success','Cadastro concluído com sucesso.');
        } else {
            DB::rollback();
            $this->notification()->error($description = 'Ocorreu um erro ao concluir rematrícula.');
        }
    }

    public function registerPayment($matriculation) {
        $balance = $this->student->community->balance ?? $this->student->parish->balance;
        $amount = $this->payment * 100;
        $balance_after = $balance->amount + $amount;
        Movementation::create([
            'parish_id' => $this->student->community_id ? null : $this->student->parish_id,
            'community_id' => $this->student->community_id ?? null,
            'user_id' => auth()->user()->id,
            'matriculation_id' => $matriculation->id,
            'description' => 'Pagamento da taxa de inscrição do ano '. $matriculation->year .' de '.$this->student->name,
            'amount' => $amount,
            'balance_before' => $balance->amount,
            'balance_after' => $balance_after,
            'date' => date('Y-m-d'),
        ]);
        $balance->update(['amount' => $balance_after]);
    }

    public function mount($student)
    {
        $this->student = $student;
        $this->groups = Group::query()
            // ->where('community_id', $student->community_id)
            ->where('finished', false)
            ->with('grade')
            ->get();
    }

    public function render()
    {
        return view('livewire.student.create.matriculation');
    }
}
