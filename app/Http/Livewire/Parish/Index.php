<?php

namespace App\Http\Livewire\Parish;

use App\Models\Parish;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $parishes = Parish::query()
            ->withCount('active_students')
            ->withCount('users')
            ->with('coordinators')
            ->get();

        return view('livewire.parish.index', [
            'parishes' => $parishes
        ]);
    }
}
