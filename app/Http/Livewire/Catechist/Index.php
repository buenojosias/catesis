<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Community;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = null;
    public $community = null;

    public function render()
    {
        if(auth()->user()->hasRole('admin')) {
            $communities = Community::all();
        }

        $catechists = User::query()
            ->with('roles')
            ->when(auth()->user()->hasRole('admin'), function($query) {
                return $query->with('community');
            })
            ->where('id', '<>', auth()->user()->id)
            ->when(auth()->user()->community_id, function($query) {
                return $query->where('community_id', auth()->user()->community_id);
            })
            ->when($this->community, function($query) {
                return $query->where('community_id', $this->community);
            })
            ->when($this->search, function($query) {
                return $query->where('name', 'LIKE', "%$this->search%");
            })
            ->orderBy('name', 'asc')
            ->paginate();

        return view('livewire.catechist.index', [
            'catechists' => $catechists,
            'communities' => $communities ?? null
        ]);
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
