<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Index extends Component implements Tables\Contracts\HasTable
{
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

    public function render()
    {
        return view('livewire.student.index');
    }
}
