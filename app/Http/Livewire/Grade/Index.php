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
            # FILTRAR POR COMUNIDADE

        return view('livewire.grade.index', [
            'grades' => $grades
        ]);
    }
}


/*
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Grade::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->label('Título'),
            Tables\Columns\TextColumn::make('active_students_count')->counts('active_students')->label('Catequizandos'),
        ];
    }

    protected function getTableRecordUrlUsing()
    {
        return fn (Grade $grade): string => route('grades.show', ['grade' => $grade]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
*/
