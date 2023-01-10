<?php

namespace App\Http\Livewire\Community;

use App\Models\Community;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $communities = Community::query()
            ->withCount('active_students')
            ->withCount('users')
            ->with('coordinators')
            ->get();

        return view('livewire.community.index', [
            'communities' => $communities
        ]);
    }
}


/*
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Community::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('Nome'),
            Tables\Columns\TextColumn::make('active_students_count')->counts('active_students')->label('Catequizandos'),
            Tables\Columns\TextColumn::make('users_count')->counts('users')->label('Catequistas'),
            Tables\Columns\TextColumn::make('coordinators.name')->label('Coordenador(es)'),
        ];
    }

    protected function getTableRecordUrlUsing()
    {
        return fn (Community $community): string => route('communities.show', ['community' => $community]);
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

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
*/
