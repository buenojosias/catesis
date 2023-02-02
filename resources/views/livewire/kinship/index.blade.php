<div>
    <div class="card">
        <div class="card-header relative" x-data="{ filters: false }">
            <div class="card-search sm:w-1/2">
                <x-input type="text" right-icon="search" wire:model.debounce.500ms="search"
                    placeholder="Buscar familiar" />
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Catequizandos vinculados</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kinships as $kinship)
                        <tr>
                            <td><a href="{{ route('kinships.show', $kinship) }}">{{ $kinship->name }}</a></td>
                            <td>{{ $kinship->students_count }}</td>
                            <td class="text-right">
                                <x-button href="{{ route('kinships.show', $kinship) }}" flat sm icon="eye" />
                            </td>
                        </tr>
                    @empty
                        <x-empty />
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-paginate">
            {{ $kinships->links() }}
        </div>
    </div>
</div>
