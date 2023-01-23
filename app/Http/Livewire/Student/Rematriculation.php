<?php

namespace App\Http\Livewire\Student;

use App\Models\Group;
use App\Models\Matriculation;
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

        $group = $this->groups -> where('id', $this->group)->first();

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
                'status' => 'ativo',
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
            return redirect()->route('students.show', [$this->student, 'historico'])->with('success','Rematrícula efetuada com sucesso.');
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao fazer rematrícula.','icon'=>'error']);
        }
    }

    protected $validationAttributes = [
        'group' => 'Grupo',
        'kinship' => 'Familiar representante',
        'comment' => 'Observações',
    ];

    public function render()
    {
        return view('livewire.student.rematriculation');
    }
}
