<?php

namespace App\Http\Livewire\Grade;

use App\Models\Grade;
use Livewire\Component;

class Index extends Component
{
    public $can_edit;

    public function mount()
    {
        $this->can_edit = auth()->user()->hasRole('admin') || (auth()->user()->hasRole('coordinator') && auth()->user()->community_id === null);
        // if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('coordinator') && auth()->user()->community_id === null)) {
        //     $this->can_edit = true;
        // }
    }
    public function render()
    {
        $grades = Grade::query()
            ->withCount('active_students')
            ->get();

        return view('livewire.grade.index', [
            'grades' => $grades
        ]);
    }
}
