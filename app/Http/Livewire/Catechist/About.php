<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Characteristic;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class About extends Component
{
    use Actions;

    public $catechist;
    public $name, $birthday, $naturalness, $marital_status, $scholarity, $catechist_from, $catechist_invitation, $encounter_preparation;
    public $characteristics, $catechistCharacteristics;
    public $groups;
    public $showEditProfileModal;
    public $weekdays = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];

    public function loadCharacteristics() {
        if(!$this->characteristics) {
            $this->characteristics = Characteristic::all();
            $catechistCharacteristics = $this->catechist->characteristics;
            $this->catechistCharacteristics = $catechistCharacteristics->pluck('id')->toArray();
        }
    }

    public function syncCharacteristc($id) {
        if(in_array($id, $this->catechistCharacteristics)) {
            $this->catechist->characteristics()->attach($id);
        } else {
            $this->catechist->characteristics()->detach($id);
        }
    }

    public function openEditProfileModal()
    {
        $this->birthday = Carbon::parse($this->birthday)->format('Y-m-d');
        if($this->catechist_from) {
            $this->catechist_from = Carbon::parse($this->catechist_from)->format('Y-m-d');
        }
        $this->showEditProfileModal = true;
    }

    public function submitProfile()
    {
        $validateCatechist = $this->validate([
            'name' => 'required|string|min:6|max:255',
        ]);
        $validateProfile = $this->validate([
            'birthday' => 'required|date|before:now',
            'naturalness' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'scholarity' => 'nullable|string|max:128',
            'catechist_from' => 'required|date|before:now',
            'catechist_invitation' => 'nullable|string',
            'encounter_preparation' => 'nullable|string',
        ]);
        // dd([$this->catechistForm, $this->profileForm]);
        try {
            if($this->catechist_from == "") { $this->catechist_from = null; };
            $saveCatechist = $this->catechist->update($validateCatechist);
            $saveProfile = $this->catechist->profile()->update($validateProfile);
            $this->notification()->success($description = 'Informações atualizadas com sucesso.');
            $this->showEditProfileModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar informações.');
            dd($th);
        }
    }

    public function mount($catechist)
    {
        $this->catechist = $catechist;
        $this->name = $catechist->name;
        $this->birthday = Carbon::parse($catechist->profile->birthday)->format('Y-m-d');
        $this->naturalness = $catechist->profile->naturalness;
        $this->marital_status = $catechist->profile->marital_status;
        $this->scholarity = $catechist->profile->scholarity;
        $this->catechist_from = Carbon::parse($catechist->profile->catechist_from)->format('Y-m-d');
        $this->catechist_invitation = $catechist->profile->catechist_invitation;
        $this->encounter_preparation = $catechist->profile->encounter_preparation;
        $this->groups = $catechist->groups()->where('year', date('Y'))->where('finished', false)->with('grade')->withCount('students')->orderBy('year', 'desc')->get();
        if(!auth()->user()->community_id) {
            $this->catechist->load('community');
        }
    }

    public function render()
    {
        return view('livewire.catechist.about');
    }
}
