<?php

namespace App\Http\Livewire\Pastoral;

use App\Models\Community;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class PerStudent extends Component
{
    use WithPagination;

    public $communities;
    public $community;
    public $community_name;
    public $has_pastoral = true;

    public function selectFilter($has_pastoral) {
        $this->has_pastoral = $has_pastoral;
    }

    public function selectCommunity($community)
    {
        $this->community = $community;
        $this->community_name = $this->communities->where('id', $this->community)->first()->name;
    }

    public function mount() {
        $this->community = auth()->user()->community_id ?? 1;
        if(!auth()->user()->community_id) {
            $this->communities = Community::all();
            $this->selectCommunity(1);
        }
    }
    public function render()
    {
        $students = Student::query()
            ->when($this->community, function ($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->has_pastoral, function ($query) {
                return $query->whereHas('pastorals');
            })
            ->when(!$this->has_pastoral, function ($query) {
                return $query->whereDoesntHave('pastorals');
            })
            ->where('status', 'Ativo')
            ->with(['pastorals.community'])
            ->orderBy('name', 'asc')
            ->paginate();
        return view('livewire.pastoral.per-student', compact('students'));
    }
}
