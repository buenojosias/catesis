<?php

namespace App\Http\Livewire\Enrollment;

use App\Models\Enrollment;
use App\Models\Group;
use App\Models\Movementation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Show extends Component
{
    use Actions;

    public $code;
    public $confirmationEnrollmentModal;
    public $enrollmentData, $student, $kinship, $isUnderNine;
    public $enrollments;
    public $group;
    public $groups;
    public $comment;
    public $payment;

    protected $validationAttributes = [
        'group' => 'Grupo',
        'comment' => 'Comentário',
    ];

    public function openConfirmModal($enrollment)
    {
        $this->enrollmentData = Enrollment::with(['student','kinship'])->find($enrollment);
        $this->student = $this->enrollmentData->student;
        $this->kinship = $this->enrollmentData->kinship;
        $maxYear = date('Y')-10;
        $maxBirthdayDate = Carbon::parse($maxYear.'-12-31');
        $this->isUnderNine = $this->student->birthday > $maxBirthdayDate;
        $this->groups = Group::query()
        ->where('finished', false)
        ->when($this->isUnderNine, function($query) {
            $query->where('grade_id', 1);
        })->with('grade')->get();
        $this->confirmationEnrollmentModal = true;
    }

    public function submitConfirmation() {
        $validGroups = $this->groups->pluck('id')->toArray();
        $validate = $this->validate([
            'group' => 'required|in:' . implode(',', $validGroups),
            'comment' => 'nullable|string',
        ]);
        $group = $this->groups->where('id', $this->group)->first();

        DB::beginTransaction();
        try {
            $matriculation = $this->student->matriculations()->create([
                'user_id' => auth()->user()->id,
                'community_id' => $this->student->community_id,
                'kinship_id' => $this->kinship->id,
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
            $update_entollment = $this->enrollmentData->update([
                'status' => 'Confirmado',
            ]);
            if($this->comment) {
                $this->student->comments()->create([
                    'user_id' => auth()->user()->id,
                    'description' => $this->comment,
                ]);
            }
        } catch (\Throwable $th) {
            $this->dialog(['description'=>'Ocorreu um erro ao confirmar inscrição.','icon'=>'error']);
            dd($th);
        }
        if($matriculation && $update_student && $update_entollment) {
            DB::commit();
            if($this->payment && $this->payment != '') {
                $this->registerPayment($matriculation);
            }
            $this->notification()->success($description = 'Inscrição confirmada com sucesso.');
            $this->confirmationEnrollmentModal = false;
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao confirmar inscrição.','icon'=>'error']);
        }
        // fechar modal
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

    public function mount($code)
    {
        $this->code = $code;
    }

    public function render()
    {
        $this->enrollments = $this->code->enrollments()->with(['student','kinship'])->get();
        return view('livewire.enrollment.show');
    }
}
