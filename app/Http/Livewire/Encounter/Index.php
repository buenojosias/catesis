<?php

namespace App\Http\Livewire\Encounter;

use App\Models\Community;
use App\Models\Encounter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $community_id;
    public $date;
    public $filter_date;
    public $period;

    public function mount($period)
    {
        $this->period = $period;
        $this->date = date('Y-m-d');
        $this->community_id = session('community_id') ?? null;
    }

    public function render()
    {
        if(auth()->user()->hasRole('admin')) {
            $communities = Community::all();
        }

        $encounters = Encounter::query()
            ->with('theme', 'group.grade')
            ->whereRelation('group', 'year', date('Y'))
            ->when(auth()->user()->hasRole('admin'), function ($query) {
                $query->with('group.community');
            })
            ->when($this->community_id, function ($query) {
                $query->whereRelation('group', 'community_id', $this->community_id);
            })
            ->when(auth()->user()->hasRole('catechist'), function ($query) {
                $groups = auth()->user()->groups()->pluck('id');
                return $query->whereIn('group_id', $groups);
            })
            ->when($this->filter_date, function ($query) {
                $query->whereDate('date', $this->filter_date);
            })
            ->when($this->period === 'proximos', function ($query) {
                $query
                    ->whereDate('date', '>=', $this->date)
                    ->orderBy('date', 'asc');
            })
            ->when($this->period === 'realizados', function ($query) {
                $query
                    ->whereDate('date', '<=', $this->date)
                    ->with('students')
                    ->orderBy('date', 'desc');
            })
            ->paginate();

        return view('livewire.encounter.index', [
            'encounters' => $encounters,
            'communities' => $communities ?? null,
        ]);
    }
}
