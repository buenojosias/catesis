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
    public $userCommunity = null;
    public $role;

    protected $queryString = [
        'search' => ['except' => ''],
        'community' => ['except' => '']
    ];

    public function updatingSearch ()
    {
        $this->resetPage();
    }

    public function updatingCommunity()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->userCommunity = session('community_id');
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
            ->when($this->userCommunity, function($query) {
                return $query->where('community_id', $this->userCommunity);
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
