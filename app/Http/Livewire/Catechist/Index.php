<?php

namespace App\Http\Livewire\Catechist;

use App\Models\User;
// use Filament\Tables;
// use Filament\Tables\Actions\Action;
// use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.catechist.index');
    }
}


/*
use Tables\Concerns\InteractsWithTable;

protected function getTableQuery(): Builder 
{
    return User::query()->where('id', '<>', auth()->user()->id);
}

protected function getTableColumns(): array
{
    return [
        Tables\Columns\TextColumn::make('name')->label('Nome')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('email')->label('E-mail'),
        Tables\Columns\TextColumn::make('community.name')->label('Comunidade'),
    ];
}

protected function getTableFilters(): array
{
    return [
        SelectFilter::make('community')->relationship('community', 'name')->label('Comunidade')
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
    return fn (User $user): string => route('catechists.show', ['user' => $user]);
}

protected function getTableActions(): array
{
    return [
        Action::make('edit')
            ->label(false)
            ->url(fn (Community $record): string => route('communities.edit', $record))
            ->icon('heroicon-s-pencil')
            //->visible(auth()->user()->can(fn (Community $record): bool => 'community_edit' or (auth()->user()->can('community_edit_self') && auth()->user()->community_id === $record['id'])))
            ->visible(fn (Community $record): bool => auth()->user()->can('community_edit', $record) or (auth()->user()->community_id === $record['id'] && auth()->user()->can('community_edit_self', $record)))
    ];
}
*/