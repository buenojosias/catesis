<?php

namespace App\Http\Livewire\Student;

use App\Models\Community;
use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = null;
    public $community = null;
    public $grade = null;
    public $status;
    public $student;

    public function render()
    {
        $grades = Grade::all();
        if(auth()->user()->hasRole('admin')) {
            $communities = Community::all();
        }

        $students = Student::query()
            ->when(auth()->user()->hasRole('admin'), function($query) {
                return $query->with('community');
            })
            ->when(auth()->user()->community_id, function($query) {
                return $query->where('community_id', auth()->user()->community_id);
            })
            ->when(auth()->user()->hasExactRoles('catechist'), function($query) {
                $students = $query->whereHas('groups', function($query) {
                    $groups = auth()->user()->groups()->where('year', date('Y'))->where('finished', false)->pluck('id');
                    return $query->whereIn('group_id', $groups);
                });
            })
            ->when($this->community, function($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->grade, function($query) {
                return $query->where('grade_id', $this->grade);
            })
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->search, function($query) {
                return $query->where('name', 'LIKE', "%$this->search%");
            })
            ->with('grade')
            ->orderBy('name', 'asc')
            ->paginate();

        return view('livewire.student.index', [
            'students' => $students,
            'grades' => $grades,
            'communities' => $communities ?? null,
        ]);
    }
}
