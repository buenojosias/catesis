<?php

namespace App\Http\Livewire\Grade;

use App\Models\Grade;
use Livewire\Component;

class Index extends Component
{
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
