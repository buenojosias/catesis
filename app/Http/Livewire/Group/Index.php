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
    public $showFormModal;
    public $grade = null;
    public $weekdays;
    public $year = 2023;
    public $years = [2023,2022,2021,2020];

    public function openFormModal() {
        $this->showFormModal = true;
    }

    public function mount($weekdays)
    {
        $this->weekdays = $weekdays;
    }

    public function render()
    {
        if(auth()->user()->hasRole('admin')) {
            $communities = Community::all();
            $grades = Grade::all();
        }

        $groups = Group::query()
            ->with(['grade', 'users'])
            ->withCount('active_students')
            ->where('year', $this->year)
            ->when(auth()->user()->hasRole('admin'), function($query) {
                return $query->with('community');
            })
            ->when(auth()->user()->community_id, function($query) {
                return $query->where('community_id', auth()->user()->community_id);
            })
            ->when($this->community, function($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->grade, function($query) {
                return $query->where('grade_id', $this->grade);
            })
            ->orderBy('grade_id', 'asc')
            ->paginate();

        return view('livewire.group.index', [
            'groups' => $groups,
            'grades' => $grades ?? null,
            'communities' => $communities ?? null
        ]);
    }
}
