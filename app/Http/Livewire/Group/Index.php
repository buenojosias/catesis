<?php

namespace App\Http\Livewire\Group;

use App\Models\Community;
use App\Models\Grade;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $years = [2023,2022,2021,2020];
    public $year = 2023;
    public $community = null;
    public $grade = null;

    public function render()
    {
        if(auth()->user()->hasRole('admin')) {
            $communities = Community::all();
            $grades = Grade::all();
        }

        $groups = Group::query()
            ->with(['grade','users'])
            ->withCount('students')
            ->where('year', $this->year)
            ->when(auth()->user()->hasRole('admin'), function($query) {
                return $query->with('community');
            })
            ->when(auth()->user()->community_id, function($query) {
                return $query->where('community_id', auth()->user()->community_id);
            })
            ->when($this->community, function($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->grade, function($query) {
                return $query->where('grade_id', $this->grade);
            })
            ->paginate();

        return view('livewire.group.index', [
            'groups' => $groups,
            'grades' => $grades ?? null,
            'communities' => $communities ?? null
        ]);
    }
}


/*
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        if(auth()->user()->hasRole('admin'))
            return Group::query();

        return Group::query()->where('community_id', auth()->user()->community_id);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('grade.title')->label('Etapa')->sortable(),
            Tables\Columns\TextColumn::make('community.name')->label('Comunidade')
                ->visible(auth()->user()->hasRole('admin')),
            Tables\Columns\TextColumn::make('students_count')->counts('students')->label('Catequizandos'),
            Tables\Columns\TextColumn::make('users.name')->label('Catequista(s)')
                ->visible(auth()->user()->hasAnyRole(['coordinator','secretary']))
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('community')->relationship('community', 'name')->label('Comunidade')
                ->visible(auth()->user()->hasRole('admin')),
            SelectFilter::make('grade')->relationship('grade', 'title')->label('Etapa')
                ->visible(auth()->user()->hasRole('admin')),
        ];
    }

    protected function getTableRecordUrlUsing()
    {
        return fn (Group $group): string => route('groups.show', ['group' => $group]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return auth()->user()->hasRole('admin');
    }
*/
