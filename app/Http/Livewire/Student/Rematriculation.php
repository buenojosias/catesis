<?php

namespace App\Http\Livewire\Student;

use App\Models\Group;
use App\Models\Movementation;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Rematriculation extends Component
{
    use Actions;

    public $student;
    public $groups;
    public $kinships;

    public $group;
    public $kinship;
    public $comment;
    public $payment;

    protected $validationAttributes = [
        'group' => 'Grupo',
        'kinship' => 'Familiar representante',
        'comment' => 'Observações',
    ];


    protected $listeners = ['submitRematriculation'];

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->kinships = $student->kinships;
        $this->groups = Group::query()
            ->where('community_id', $student->community_id)
            ->when($student->grade_id, function($query) use ($student) {
                return $query->where('grade_id', '>=', $student->grade_id);
            })
            ->where('finished', false)
            ->with('grade')
            ->get();
    }

    public function submitRematriculation() {
        $validGroups = $this->groups->pluck('id')->toArray();
        $validKinships = $this->kinships->pluck('id')->toArray();
        $validate = $this->validate([
            'group' => 'required|in:' . implode(',', $validGroups),
            'kinship' => 'required|in:' . implode(',', $validKinships),
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
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $update_student = $this->student->update([
                'grade_id' => $group->grade_id,
                'status' => 'Ativo',
            ]);
            if($this->comment) {
                $this->student->comments()->create([
                    'user_id' => auth()->user()->id,
                    'description' => $this->comment,
                ]);
            }
        } catch (\Throwable $th) {
            $this->dialog(['description'=>'Ocorreu um erro ao fazer rematrícula.','icon'=>'error']);
            dd($th);
        }
        if($matriculation && $update_student) {
            DB::commit();
            if($this->payment && $this->payment != '') {
                $this->registerPayment($matriculation);
            }
            return redirect()->route('students.show', [$this->student, 'historico'])->with('success','Rematrícula efetuada com sucesso.');
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao fazer rematrícula.','icon'=>'error']);
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

    public function render()
    {
        return view('livewire.student.rematriculation');
    }
}
