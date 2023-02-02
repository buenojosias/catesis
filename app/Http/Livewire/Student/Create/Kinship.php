<?php

namespace App\Http\Livewire\Student\Create;

use App\Models\Kinship as KinshipModel;
use App\Models\KinshipTitle;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Kinship extends Component
{
    use Actions;

    public $titles;
    public $contact;
    public $option;
    public $student;
    public $kinship;
    public $ksid, $name, $birthday, $title, $is_enroller = false, $lives_together = false;
    public $phone, $whatsapp, $email, $facebook, $instagram;

    protected $validationAttributes = [
        'ksid' => 'Familiar cadastrado',
        'name' => 'Nome do responsável',
        'birthday' => 'Data de nascimento',
        'title' => 'Grau de parentesco',
        'is_enroller' => 'É responsável',
        'lives_together' => 'Mora junto',
        'phone' => 'Telefone',
        'whatsapp' => 'WhatsApp',
        'email' => 'E-mail',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
    ];

    public function submit() {
        $validateKinship = $this->validate([
            'ksid' => 'nullable|required_if:option,sync|integer',
            'name' => 'nullable|required_if:option,create|string|min:6|max:166',
            'birthday' => 'nullable|required_if:option,create|date|before:now',
            'title' => 'required|string|in:' . implode(',', $this->titles->toArray()),
            'is_enroller' => 'required|boolean',
            'lives_together' => 'required|boolean',
        ]);
        if($this->option == 'create') {
            $validateContact = $this->validate([
                'phone' => 'nullable|required_without:whatsapp|string|min:14|max:15',
                'whatsapp' => 'nullable|required_without:phone|string|min:14|max:15',
                'email' => 'nullable|email',
                'facebook' => 'nullable|url',
                'instagram' => 'nullable|url',
            ]);
        }

        DB::beginTransaction();
        try {
            if($this->option === 'create') {
                $kinship = KinshipModel::create([
                    'name' => $this->name,
                    'birthday' => $this->birthday,
                ]);
                $kinship->profile()->create(['profession'=>null]);
                $contact = $kinship->contact()->create($validateContact);
            } else if($this->option === 'sync') {
                $kinship = KinshipModel::with('contact')->find($this->ksid);
                $contact = $kinship->contact;
                if(!$contact) {
                    $contact = $kinship->contact()->create([
                        'phone' => '(00) 0000-0000',
                        'whatsapp' => '(00) 00000-0000'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao cadastrar/vincular familiar.');
            dd($th);
        }
        if($kinship && $contact) {
            DB::commit();
            $kinship->students()->attach($this->student, [
                'title' => $this->title,
                'is_enroller' => $this->is_enroller,
                'lives_together' => $this->lives_together,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->kinship = $kinship;
            $this->contact = $contact;
            $this->emit('emitKinship', $kinship->id);
            $this->notification()->success($description = 'Familiar cadastrado/vinculado com sucesso.');
            $this->dispatchBrowserEvent('close', ['form' => false]);
        } else {
            DB::rollback();
            $this->notification()->error($description = 'Ocorreu um erro ao cadastrar/vincular familiar.');
        }
    }

    public function mount()
    {
        $this->titles = KinshipTitle::all()->pluck('title');
    }

    public function render()
    {
        return view('livewire.student.create.kinship');
    }
}
