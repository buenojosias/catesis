<?php

namespace App\Http\Livewire\Community;

use App\Models\Community;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $communities = Community::query()
            ->withCount('active_students')
            ->withCount('users')
            ->with('coordinators')
            ->get();

        return view('livewire.community.index', [
            'communities' => $communities
        ]);
    }
}
