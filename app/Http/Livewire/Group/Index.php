<?php

namespace App\Http\Livewire\Group;

use App\Models\Community;
use App\Models\Grade;
use App\Models\Group;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $community = null;
    public $showFormModal;
    public $grade = null;
    public $weekdays;
    public $year;
    public $years;

    protected $queryString = [
        'year' => ['exept' => ''],
        'grade' => ['exept' => ''],
        'community' => ['exept' => '']
    ];

    public function updatingYear()
    {
        $this->resetPage();
    }

    public function updatingGrade()
    {
        $this->resetPage();
    }

    public function updatingCommunity()
    {
        $this->resetPage();
    }

    public function openFormModal()
    {
        $this->showFormModal = true;
    }

    public function mount($weekdays)
    {
        $this->year = date('Y');
        $this->years = collect();
        for($i = $this->year; $i >= 2022; $i--) {
            $this->years->push($i);
        };
        $this->weekdays = $weekdays;
    }

    public function render()
    {
        if (auth()->user()->hasRole('admin')) {
            $communities = Community::all();
            $grades = Grade::all();
        }

        $groups = Group::query()
            ->with(['grade', 'users'])
            ->withCount('active_students')
            ->where('year', $this->year)
            ->when(auth()->user()->hasRole('admin'), function ($query) {
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
