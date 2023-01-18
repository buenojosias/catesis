<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Community;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = null;
    public $community = null;

    public function render()
    {
        if(auth()->user()->hasRole('admin')) {
            $communities = Community::all();
        }

        $catechists = User::query()
            ->with('roles')
            ->when(auth()->user()->hasRole('admin'), function($query) {
                return $query->with('community');
            })
            ->where('id', '<>', auth()->user()->id)
            ->when(auth()->user()->community_id, function($query) {
                return $query->where('community_id', auth()->user()->community_id);
            })
            ->when($this->community, function($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->search, function($query) {
                return $query->where('name', 'LIKE', "%$this->search%");
            })
            ->orderBy('name', 'asc')
            ->paginate();

        return view('livewire.catechist.index', [
            'catechists' => $catechists,
            'communities' => $communities ?? null
        ]);
    }
}
