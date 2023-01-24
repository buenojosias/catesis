<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;
use WireUi\Traits\Actions;

class About extends Component
{
    use Actions;

    public $avaliable_catechists;
    public $catechists;
    public $community;
    public $group;
    public $selected_catechist;
    public $showFormModal;
    public $showCatechistsModal;
    public $students_count;
    public $weekdays;

    public function openFormModal()
    {
        $this->showFormModal = true;
    }

    public function openCatechistsModal()
    {
        $this->avaliable_catechists = $this->group->community->users()->whereDoesntHave('groups', function ($query) {
            return $query->where('group_id', $this->group->id);
        })->orderBy('name', 'asc')->get();
        $this->showCatechistsModal = true;
    }

    public function hideCatechistsModal()
    {
        $this->showCatechistsModal = false;
    }

    public function syncCatechist()
    {
        if ($this->selected_catechist) {
            $selected = $this->avaliable_catechists->where('id', $this->selected_catechist);
            try {
                $this->group->users()->syncWithoutDetaching($this->selected_catechist);
                $this->catechists->push($selected->first());
                $this->notification()->success($description = 'Catequista adicionado com sucesso.');
                $this->hideCatechistsModal();
                $this->avaliable_catechists = $this->group->community->users()->whereDoesntHave('groups', function ($query) {
                    return $query->where('group_id', $this->group->id);
                })->get();
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Erro ao adicionar catequista.');
            }
        } else {
            $this->notification()->error($description = 'Selecione um catequista.');
        }
    }

    public function detachCatechist($catechist)
    {
        try {
            $this->group->users()->detach($catechist['id']);
            $this->catechists = $this->group->users()->get();
            $this->notification()->success($description = 'Catequista removido(a) com sucesso.');
            $this->hideCatechistsModal();
            $this->avaliable_catechists = $this->group->community->users()->whereDoesntHave('groups', function ($query) {
                return $query->where('group_id', $this->group->id);
            })->get();
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Erro ao remover catequista.');
            dd($th);
        }
    }

    public function mount($group, $weekdays)
    {
        $this->group = $group;
        $this->catechists = $this->group->users;
        $this->students_count = $group->students()->count();
        if(auth()->user()->hasRole('admin')) {
            $this->community = $group->community;
        }
        $this->weekdays = $weekdays;
    }

    public function render()
    {
        return view('livewire.group.about');
    }
}
