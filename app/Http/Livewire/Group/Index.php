<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component implements Tables\Contracts\HasTable
{
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
    
    public function render()
    {
        return view('livewire.group.index');
    }
}
