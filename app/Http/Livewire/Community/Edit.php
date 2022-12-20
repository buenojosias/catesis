<?php

namespace App\Http\Livewire\Community;

use App\Models\Community;
use Livewire\Component;

class Edit extends Component
{
    public $community;

    public function mount(Community $community)
    {
        $this->community = $community;
    }

    public function render()
    {
        return view('livewire.community.edit', [
            'community' => $this->community
        ]);
    }
}
