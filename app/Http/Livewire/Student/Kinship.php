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

    public $option;
    public $kinships;
    public $student;
    public $kinshipCreateModal;

    public $titles;
    public $ks_id;
    public $ks_name;
    public $ks_birth;
    public $ks_title;
    public $ks_is_enroller = false;
    public $ks_live_together = false;

    protected $validationAttributes = [
        'ks_id' => 'Familiar cadastrado',
        'ks_name' => 'Nome',
        'ks_birth' => 'Data de nascimento',
        'ks_title' => 'Grau de parentesco',
        'ks_is_enroller' => 'É responsável',
        'ks_live_together' => 'Mora junto',
    ];

    public function kinshipSubmit() {
        $validateKinship = $this->validate([
            'ks_id' => 'nullable|required_if:option,sync|integer',
            'ks_name' => 'nullable|required_if:option,create|string|min:6|max:166',
            'ks_birth' => 'nullable|required_if:option,create|date|before:now',
            'ks_title' => 'required|string|in:' . implode(',', $this->titles->toArray()),
            'ks_is_enroller' => 'required|boolean',
            'ks_live_together' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            if($this->option === 'create') {
                $kinship = KinshipModel::create([
                    'name' => $this->ks_name,
                    'birth' => $this->ks_birth,
                ]);
            } else if($this->option === 'sync') {
                $kinship = KinshipModel::find($this->ks_id);
            }
            $kinship->students()->attach($this->student, [
                'title' => $this->ks_title,
                'is_enroller' => $this->ks_is_enroller,
                'live_together' => $this->ks_live_together,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $th) {
            $this->dialog(['description'=>'Ocorreu um erro ao cadastrar/vincular familiar.','icon'=>'error']);
            dd($th);
        }
        if($kinship) {
            DB::commit();
            $this->kinships->push($kinship);
            $this->dialog(['description'=>'Familiar cadastrado/vinculado com sucesso.','icon'=>'success']);
            $this->kinshipCreateModal = false;
        } else {
            DB::rollback();
            $this->dialog(['description'=>'Ocorreu um erro ao cadastrar/vincular familiar.','icon'=>'error']);
        }
    }

    public function mount(Student $student)
    {
        $this->kinships = $student->kinships;
        $this->titles = KinshipTitle::all()->pluck('title');
    }

    public function render()
    {
        return view('livewire.student.kinship');
    }
}
