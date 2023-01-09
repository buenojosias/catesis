<?php

namespace App\Http\Livewire\Grade;

use App\Models\Grade;
// use Filament\Tables;
// use Filament\Tables\Actions\Action;
// use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.grade.index');
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