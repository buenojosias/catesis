<?php

namespace App\Http\Livewire\Pastoral;

use App\Models\Community;
use App\Models\Pastoral;
use Livewire\Component;
use WireUi\Traits\Actions;

class PerPastoral extends Component
{
    use Actions;

    public $communities;
    public $community;
    public $community_name;
    public $method;
    public $form;
    public $pastorals;
    public $showFormModal;

    protected $validationAttributes = [
        'form.community_id' => 'Comunidade',
        'form.name' => 'Nome do movimento/pastoral',
        'form.coordinator' => 'Coordenador',
        'form.encounters' => 'Dia/horário dos encontros',
    ];


    public function selectCommunity($community)
    {
        $this->community = $community;
    }

    public function openFormModal($method, $pastoral = null)
    {
        $this->method = $method;
        $this->form = $pastoral;
        if($this->method === 'create') {
            $this->form['community_id'] = $this->community;
        }
        $this->showFormModal = true;
    }

    public function closeFormModal()
    {
        $this->showFormModal = false;
    }

    public function submit() {
        $validCommunities = $this->communities->pluck('id')->toArray();
        $validate = $this->validate([
            'form.community_id' => 'required|integer|in:' . implode(',', $validCommunities),
            'form.name' => 'required|string|max:132',
            'form.coordinator' => 'nullable|string|max:132',
            'form.encounters' => 'nullable|string|max:132',
        ]);
        if ($this->method === 'create') {
            try {
                $pastoral = auth()->user()->pastorals()->create($this->form);
                $this->notification()->success($description = 'Movimento/pastoral salva com sucesso.');
                // $this->pastorals->push($pastoral);
                $this->selectCommunity($pastoral->community->id);
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                dd($th);
                $this->notification()->error($description = 'Ocorreu um erro ao salvar movimento/pastoral.');
            }
        } else if ($this->method === 'edit') {
            try {
                $save = Pastoral::findOrFail($this->form['id'])->update($this->form);
                $this->notification()->success($description = 'Movimento/pastoral salva com sucesso salvo com sucesso.');
                //$this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                dd($th);
                $this->notification()->error($description = 'Ocorreu um erro ao salvar movimento/pastoral.');
            }
        }
    }

    public function mount()
    {
        $this->community = auth()->user()->community_id ?? 1;
        $this->communities = Community::all();
    }

    public function render()
    {
        $this->community_name = $this->communities->where('id', $this->community)->first()->name;
        $this->pastorals = Pastoral::query()
            ->when($this->community, function ($query) {
                return $query->where('community_id', $this->community);
            })
            ->with(['community', 'kinships','students.community'])
            ->orderBy('name')
            ->get();
        return view('livewire.pastoral.per-pastoral');
    }
}
