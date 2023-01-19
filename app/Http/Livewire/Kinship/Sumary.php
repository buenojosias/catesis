<?php

namespace App\Http\Livewire\Kinship;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Sumary extends Component
{
    use Actions;

    public $kinship;
    public $profile;
    public $name, $birth;
    public $profession, $marital_status, $religion, $catechizing, $has_baptism, $has_eucharist, $has_chrism, $attends_church, $is_tither, $musical_instrument;

    public $showEditProfileModal;

    protected $validationAttributes = [
        'name' => 'Nome',
        'birth' => 'Data de nascimento',
        'profession' => 'Profissão',
        'marital_status' => 'Estado civil',
        'religion' => 'Religião',
        'catechizing' => 'Faz catequese',
        'has_baptism' => 'É batizado',
        'has_eucharist' => 'Tem Eucaristia',
        'has_chrism' => 'Tem Crisma',
        'attends_church' => 'Frequenta a igreja',
        'is_tither' => 'É dizimista',
        'musical_instrument' => 'Instrumento musical',
    ];

    public function mount($kinship)
    {
        $this->kinship = $kinship;
        $this->profile = $kinship->profile;
        $this->name = $kinship->name;
        $this->birth = $kinship->birth;
        $this->profession = $this->profile->profession;
        $this->marital_status = $this->profile->marital_status;
        $this->religion = $this->profile->religion;
        $this->catechizing = $this->profile->catechizing;
        $this->has_baptism = $this->profile->has_baptism;
        $this->has_eucharist = $this->profile->has_eucharist;
        $this->has_chrism = $this->profile->has_chrism;
        $this->attends_church = $this->profile->attends_church;
        $this->is_tither = $this->profile->is_tither;
        $this->musical_instrument = $this->profile->musical_instrument;
    }

    public function submitProfile()
    {
        $validateKinship = $this->validate([
            'name' => 'required|string|min:6|max:255',
            'birth' => 'required|date|before:now',
        ]);
        $validateProfile = $this->validate([
            'profession' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:20',
            'religion' => 'nullable|string|max:50',
            'catechizing' => 'nullable|boolean',
            'has_baptism' => 'nullable|boolean',
            'has_eucharist' => 'nullable|boolean',
            'has_chrism' => 'nullable|boolean',
            'attends_church' => 'nullable|boolean',
            'is_tither' => 'nullable|boolean',
            'musical_instrument' => 'nullable|string|max:50',
        ]);
        try {
            $saveKinship = $this->kinship->update($validateKinship);
            $saveProfile = $this->kinship->profile()->update($validateProfile);
            // $this->kinship = $validateKinship;
            // $this->profile = $validateProfile;
            $this->notification()->success($description = 'Informações atualizadas com sucesso.');
            $this->showEditProfileModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar informações.');
            dd($th);
        }
    }

    public function openEditProfileModal()
    {
        $this->showEditProfileModal = true;
    }

    public function render()
    {
        return view('livewire.kinship.sumary');
    }
}

/*

profession
marital_status
religion
catechizing
has_baptism
has_eucharist
has_chrism
attends_church
is_tither
musical_instrument

*/
