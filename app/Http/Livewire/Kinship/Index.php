<?php

namespace App\Http\Livewire\Kinship;

use App\Models\Kinship;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = null;

    public function render()
    {
        $kinships = Kinship::query()
            ->when($this->search, function($query) {
                return $query->where('name', 'LIKE', "%$this->search%");
            })
            ->withCount('students')
            ->orderBy('name', 'asc')
            ->paginate();

        return view('livewire.kinship.index', [
            'kinships' => $kinships,
        ]);
    }
}
