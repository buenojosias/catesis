<div>
    <div class="card">
        @if($role === 'admin')
            <div class="card-header relative" x-data="{ filters: false }">
                <div class="card-search">
                    <x-input type="text" right-icon="search" wire:model.debounce.500ms="search"
                        placeholder="Buscar catequista" />
                </div>
                <div class="card-tools">
                    <x-button flat icon="filter" @click="filters = !filters" />
                </div>
                <div x-show="filters" @click.outside="filters = false" class="filters">
                    <div>
                        <x-native-select label="Comunidade" wire:model="community">
                            <option value="">Todas</option>
                            @foreach ($communities as $community)
                                <option value="{{ $community->id }}">{{ $community->name }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        @if($role === 'admin')
                            <th>Comunidade</th>
                        @endif
                        <th>Função</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($catechists as $catechist)
                        <tr>
                            <td><a href="{{ route('catechists.show', $catechist) }}">{{ $catechist->name }}</a></td>
                            @if($role === 'admin')
                                <td>{{ $catechist->community->name ?? '' }}</td>
                            @endif
                            <td>{{ $catechist->roles[0]->label ?? 'Nenhuma' }}</td>
                            <td class="text-right">
                                <x-button href="{{ route('catechists.show', $catechist) }}" flat sm icon="eye" />
                            </td>
                        </tr>
                    @empty
                        <x-empty />
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-paginate">
            {{ $catechists->links() }}
        </div>
    </div>
</div>
