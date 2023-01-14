<?php

namespace App\Http\Livewire\Student;

use App\Models\Kinship as KinshipModel;
use App\Models\KinshipTitle;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Kinship extends Component
{
    use Actions;

    public $kinships;
    public $student;
    public $kinshipCreateModal;

    public $titles;
    public $ks_name;
    public $ks_birth;
    public $ks_title;
    public $ks_is_enroller = false;
    public $ks_live_together = false;

    protected $validationAttributes = [
        'ks_name' => 'Nome',
        'ks_birth' => 'Data de nascimento',
        'ks_title' => 'Grau de parentesco',
        'ks_is_enroller' => 'É responsável',
        'ks_live_together' => 'Mora junto',
    ];

    public function kinshipSubmit() {
        $validateKinship = $this->validate([
            'ks_name' => 'required|string|min:6|max:166',
            'ks_birth' => 'required|date|before:now',
            'ks_title' => 'required|string|in:' . implode(',', $this->titles->toArray()),
            'ks_is_enroller' => 'required|boolean',
            'ks_live_together' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            $kinship = KinshipModel::create([
                'name' => $this->ks_name,
                'birth' => $this->ks_birth,
            ]);
            $kinship->students()->attach($this->student, [
                'title' => $this->ks_title,
                'is_enroller' => $this->ks_is_enroller,
                'live_together' => $this->ks_live_together,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $th) {
            $this->dialog(['description'=>'Ocorreu um erro ao cadastrar familiar.','icon'=>'error']);
            dd($th);
        }
        if($kinship) {
            DB::commit();
            $this->kinships->push($kinship);
            $this->dialog(['description'=>'Familiar cadastrado com sucesso.','icon'=>'success']);
            $this->kinshipCreateModal = false;
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao cadastrar familiar.','icon'=>'error']);
        }
    }

    public function mount(Student $student)
    {
        // $this->student = $student;
        $this->kinships = $student->kinships;
        $this->titles = KinshipTitle::all()->pluck('title');
    }

    public function render()
    {
        return view('livewire.student.kinship');
    }
}
