<div>
    <x-notifications />
    @can('group_edit')
        <x-button wire:click="openFormModal" label="Cadastrar para todos os grupos" primary class="mb-4 w-full sm:w-auto" />
    @endcan
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
                        @role('admin')
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
                            @role('admin')
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

    @if (auth()->user()->can('group_edit') && $showFormModal)
        <x-modal wire:model.defer="showFormModal" max-width="md">
            <form wire:submit.prevent="submitEncounter">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar encontro para todos os grupos</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="grid grid-cols-2 space-y-3 space-y-0 gap-4">
                            <div>
                                <x-datetime-picker wire:model.defer="form.date" label="Data"
                                    placeholder="Data do encontro" without-tips without-timezone without-time />
                            </div>
                            <x-native-select wire:model.defer="form.method" label="Modalidade">
                                <option value="">Selecione</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Familiar">Familiar</option>
                            </x-native-select>
                            <div class="col-span-2">
                                <x-native-select wire:model.defer="form.theme_id" label="Tema">
                                    <option value="">Selecione</option>
                                    @foreach ($themes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button x-on:click="close" sm flat label="Cancelar" />
                            <x-button type="submit" sm primary label="Salvar" />
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    @endif
</div>
