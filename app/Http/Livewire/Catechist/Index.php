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
    public $role;

    public function mount()
    {
        $this->role = session('role');
    }
    public function render()
    {
        if($this->role === 'admin') {
            $communities = Community::all();
        }

        $catechists = User::query()
            ->with('roles')
            ->when($this->role === 'admin', function($query) {
                return $query->with('community');
            })
            // ->where('id', '<>', auth()->user()->id)
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
