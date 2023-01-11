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
    public $status = 'ativo';

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
            ->when(auth()->user()->hasRole('catechist'), function($query) {
                $students = $query->whereHas('groups', function($query) {
                    $groups = auth()->user()->groups()->where('year', date('Y'))->where('finished', false)->pluck('id');
                    return $query->whereIn('group_id', $groups);
                });
                # DEPOIS VERIFICAR SE ESTÁ SEMPRE BUSCANDO OS CATEQUIZANDOS O CATEQUISTA LOGADO
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


/*
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        if(auth()->user()->hasRole('admin'))
            return Student::query();

        if(auth()->user()->hasRole('catechist'))
            return Student::query()
                ->where('community_id', auth()->user()->community_id);
                //->where('group_id', auth()->user()->community_id);

        return Student::query()->where('community_id', auth()->user()->community_id);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('Nome')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('community.name')->label('Comunidade')->sortable()
                ->visible(auth()->user()->hasRole('admin')),
            Tables\Columns\TextColumn::make('grade.title')->label('Etapa atual')->sortable(),
            Tables\Columns\TextColumn::make('status')->label('Status'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('community')->relationship('community', 'name')->label('Comunidade')
                ->visible(auth()->user()->hasRole('admin')),
            SelectFilter::make('grade')->relationship('grade', 'title')->label('Etapa')
                ->visible(auth()->user()->hasAnyRole(['admin','coordinator','secretary'])),
            SelectFilter::make('status')->label('Status')
                ->options([
                    'ativo' => 'Ativos',
                    'desistente' => 'Desistentes',
                ]),
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'name';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'asc';
    }

    protected function getTableRecordUrlUsing()
    {
        return fn (Student $student): string => route('students.show', ['student' => $student]);
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
                ->label(false)
                ->url(fn (Student $record): string => route('students.edit', $record))
                ->icon('heroicon-s-pencil')
                ->visible(fn (Student $record): bool => auth()->user()->can('student_edit', $record))
        ];
    }
*/
