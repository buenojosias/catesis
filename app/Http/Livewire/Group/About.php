<?php

namespace App\Http\Livewire\Group;

use App\Models\Encounter;
use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class About extends Component
{
    use Actions;

    public $community_id;
    public $user_id;
    public $role;
    public $avaliable_catechists;
    public $catechists;
    public $community;
    public $current_group;
    public $group;
    public $selected_catechist;
    public $showFormModal;
    public $showCatechistsModal;
    public $students_count;
    public $weekdays;
    public $currentEncounter;

    public function openFormModal()
    {
        $this->showFormModal = true;
    }

    public function openCatechistsModal()
    {
        $this->avaliable_catechists = User::query()
            ->when($this->group->community, function ($query) {
                $query->where('community_id', $this->group->community_id);
            })
            ->whereDoesntHave('groups', function ($query) {
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
                $this->avaliable_catechists = User::query()
                ->when($this->group->community, function ($query) {
                    $query->where('community_id', $this->group->community_id);
                })
                ->whereDoesntHave('groups', function ($query) {
                    return $query->where('group_id', $this->group->id);
                })->orderBy('name', 'asc')->get();
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
            $this->avaliable_catechists = User::query()
            ->when($this->group->community, function ($query) {
                $query->where('community_id', $this->group->community_id);
            })
            ->whereDoesntHave('groups', function ($query) {
                return $query->where('group_id', $this->group->id);
            })->orderBy('name', 'asc')->get();
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Erro ao remover catequista.');
            dd($th);
        }
    }

    public function getCurrentEncounter() {
        if ($this->group->users->contains($this->user_id)) {
            $this->current_group = $this->group->encounters()->where('date', date('Y-m-d'))->first();
        }
    }

    public function mount($group, $weekdays)
    {
        $this->user_id = session('user_id');
        $this->community_id = session('community_id');
        $this->role = session('role');
        $this->group = $group;
        $this->catechists = $this->group->users;
        $this->students_count = $group->active_students()->count();
        if($this->role === 'admin') {
            $this->community = $group->community;
        }
        if($this->role === 'catechist' && $this->catechists->contains(auth()->user())) {
            //
        }
        $this->weekdays = $weekdays;
        $this->getCurrentEncounter();
    }

    public function render()
    {
        return view('livewire.group.about');
    }
}
