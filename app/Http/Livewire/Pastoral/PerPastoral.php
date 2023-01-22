<?php

namespace App\Http\Livewire\Pastoral;

use App\Models\Community;
use App\Models\Pastoral;
use Livewire\Component;

class PerPastoral extends Component
{
    public $communities;
    public $community;
    public $community_name;
    public $pastorals;

    public function selectCommunity($community)
    {
        $this->community = $community;
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
