<?php

namespace App\Http\Livewire\Group;

use App\Models\Community;
use App\Models\Grade;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $community = null;
    public $can_create;
    public $showFormModal;
    public $grade = null;
    public $role;
    public $weekdays;
    public $year = 2023;
    public $years = [2023, 2022, 2021, 2020];

    public function openFormModal()
    {
        $this->showFormModal = true;
    }

    public function mount($weekdays)
    {
        $this->role = session('role');
        $this->can_create = in_array('group_create', session('permissions')->toArray());
        $this->weekdays = $weekdays;
    }

    public function render()
    {
        if ($this->role === 'admin') {
            $communities = Community::all();
            $grades = Grade::all();
        }

        $groups = Group::query()
            ->with(['grade', 'users'])
            ->withCount('active_students')
            ->where('year', $this->year)
            ->when($this->role === 'admin', function ($query) {
                return $query->with('community');
            })
            ->when($this->community, function ($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->grade, function ($query) {
                return $query->where('grade_id', $this->grade);
            })
            ->orderBy('grade_id', 'asc')
            ->paginate();

        foreach ($groups as $group) {
            # VERIFICAR GRUPOS DO USUÁRIO AUTENTICADO
            if ($group->users->contains(session('user_id'))) {
                $group->priority = 1;
            } else {
                $group->priority = 0;
            }
        }

        return view('livewire.group.index', [
            'groups' => $groups,
            'grades' => $grades ?? null,
            'communities' => $communities ?? null
        ]);
    }
}
