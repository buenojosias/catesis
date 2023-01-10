<div>
    <div class="card">
        <div class="card-header relative" x-data="{ filters: false }">
            <div class="card-search">
                <x-input type="text" right-icon="search" wire:model.debounce.500ms="search" placeholder="Buscar catequista" />
            </div>
            @role('admin')
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
            @endrole
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        @hasrole('admin')
                            <th>Comunidade</th>
                        @endhasrole
                        <th>Função</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catechists as $catechist)
                        <tr>
                            <td><a href="{{ route('catechists.show', $catechist) }}">{{ $catechist->name }}</a></td>
                            @hasrole('admin')
                                <td>{{ $catechist->community->name }}</td>
                            @endhasrole
                            <td>{{ $catechist->roles[0]->label }}</td>
                            <td class="text-right">
                                <x-button href="{{ route('catechists.show', $catechist) }}" flat primary sm
                                    icon="eye" />
                                @can('catechist_edit')
                                    <x-button flat primary sm icon="pencil" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-paginate">
            {{ $catechists->links() }}
        </div>
    </div>
</div>
