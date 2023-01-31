<?php

namespace App\Http\Livewire\Pastoral;

use App\Models\Community;
use App\Models\Pastoral;
use Livewire\Component;
use WireUi\Traits\Actions;

class RelatedList extends Component
{
    use Actions;

    public $showList;
    public $model;
    public $pastorals;

    public $communities;
    public $community_id;
    public $community_pastorals = []; # excluir já vinculadas
    public $form;
    public $pastoral_id;
    public $showFormModal;

    protected $validationAttributes = [
        'community_id' => 'Comunidade',
        'pastoral_id' => 'Movimento ou pastoral',
    ];

    public function loadList()
    {
        $this->pastorals = $this->model->pastorals()->with('community')->get();
        $this->showList = true;
    }

    public function openFormModal()
    {
        $this->communities = Community::all();
        $this->showFormModal = true;
    }

    public function closeFormModal()
    {
        $this->showFormModal = false;
    }

    public function syncPastoral() {
        $validCommunities = $this->communities->pluck('id')->toArray();
        if ($this->community_pastorals) {
            $validPastorals = $this->community_pastorals->pluck('id')->toArray();
        }
        $validate = $this->validate([
            'community_id' => 'nullable|integer|in:' . implode(',', $validCommunities),
            'pastoral_id' => 'required|integer|in:' . implode(',', $validPastorals),
        ]);
        try {
            $this->model->pastorals()->syncWithoutDetaching([$this->pastoral_id]);
            $this->pastorals->push($this->community_pastorals->where('id', $this->pastoral_id)->first());
            $this->community_id = $this->pastoral_id = null;
            $this->closeFormModal();
            $this->notification()->success($description = 'Movimento/pastoral vinculado com sucesso.');
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao vincular movimento ou pastoral.');
            dd($th);
        }
    }

    public function detach($pastoral): void
    {
        $this->dialog()->confirm([
            'title' => 'Desvincular movimento ou pastoral',
            'description' => 'Tem certeza que deseja desvincular '.$pastoral['name'].'?',
            'method' => 'doDetach',
            'params' => ['pastoral' => $pastoral['id']],
            'acceptLabel' => 'Confirmar',
            'rejectLabel' => 'Cancelar',
        ]);
    }

    public function doDetach($pastoral) {
        try {
            $this->model->pastorals()->detach($pastoral);
            $this->pastorals = $this->model->pastorals()->with('community')->get();
            $this->notification()->success($description = 'Movimento/pastoral removido com sucesso.');
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao remover movimento/pastoral.');
            dd($th);
        }
    }

    public function mount($model) {
        $this->model = $model;
    }

    public function render()
    {
        if (session('role') !== 'admin' && !auth()->user()->community_id) {
            $this->community_pastorals = Pastoral::query()->orderBy('name', 'asc')->get();
        } else if ($this->community_id) {
            $this->community_pastorals = Pastoral::query()->where('community_id', $this->community_id)->orderBy('name', 'asc')->get();
        } else {
            $this->community_pastorals = [];
        }
        return view('livewire.pastoral.related-list');
    }
}
