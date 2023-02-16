<div class="card">
    <div class="card-header relative" x-data="{ filters: false }">
        <h3 class="title"></h3>
        <div class="card-tools py-1">
            <x-button flat icon="filter" @click="filters = !filters" />
        </div>
        <div x-show="filters" @click.outside="filters = false" class="filters">
            @role('admin')
                <div>
                    <x-native-select label="Comunidade" wire:model="community_id">
                        <option value="">Todas</option>
                        @foreach ($communities as $community)
                            <option value="{{ $community->id }}">{{ $community->name }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            @endrole
            <div>
                @if ($period === 'realizados')
                    <x-datetime-picker without-time label="Filtrar por data" placeholder="Selecione uma data"
                        wire:model="filter_date" clearable="false" :max="now()" />
                @else
                    <x-datetime-picker without-time label="Filtrar por data" placeholder="Selecione uma data"
                        wire:model="filter_date" clearable="false" :min="now()" />
                @endif
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover whitespace-nowrap">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Grupo</th>
                    @role ('admin')
                        <th>Comunidade</th>
                    @endrole
                    <th>Tema</th>
                    @if ($period && $period === 'realizados')
                        <th width="1%" class="text-center">Presenças</th>
                        <th width="1%" class="text-center">Faltas</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($encounters as $encounter)
                    <tr>
                        <td>
                            <a href="{{ route('groups.encounter', [$encounter->group, $encounter]) }}">
                                {{ $encounter->date->format('d/m/Y') }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('groups.show', $encounter->group) }}">
                                {{ $encounter->group->grade->title }}
                        </td>
                        </a>
                        @role ('admin')
                            <td>{{ $encounter->group->community->name }}</td>
                        @endrole
                        <td>{{ $encounter->theme->title ?? '' }}</td>
                        @if ($period && $period === 'realizados')
                            @if ($encounter->students->count() === 0)
                                <td colspan="2" class="text-center text-sm text-gray-500">Sem lançamento</td>
                            @else
                                <td class="text-center">
                                    {{ $encounter->students->where('pivot.attendance', 'C')->count() }}</td>
                                <td class="text-center">
                                    {{ $encounter->students->where('pivot.attendance', 'F')->count() }}</td>
                            @endif
                        @endif
                    </tr>
                @empty
                    <x-empty />
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-paginate">
        {{ $encounters->links() }}
    </div>
</div>
