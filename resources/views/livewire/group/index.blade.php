<div>
    @if($can_create)
        <x-button wire:click="openFormModal()" label="Novo grupo" primary class="mb-3 w-full sm:w-auto" />
    @endif
    <div class="card">
        <div class="card-header relative" x-data="{ filters: false }">
            <div class="card-search"></div>
            <div class="card-tools py-1">
                <x-button flat icon="filter" @click="filters = !filters" />
            </div>
            <div x-show="filters" @click.outside="filters = false" class="filters">
                @if($role === 'admin')
                    <div>
                        <x-native-select label="Etapa" wire:model="grade">
                            <option value="">Todas</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->title }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                    <div>
                        <x-native-select label="Comunidade" wire:model="community">
                            <option value="">Todas</option>
                            @foreach ($communities as $community)
                                <option value="{{ $community->id }}">{{ $community->name }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                @endif
                <div>
                    <x-native-select label="Ano" wire:model="year">
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Etapa</th>
                        @if($role === 'admin')
                            <th>Comunidade</th>
                        @endif
                        <th>Catequizandos</th>
                        <th>Catequista(s)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups->sortByDesc('priority') as $group)
                        <tr class="{{ $group->priority == 1 ? 'bg-slate-100' : '' }}">
                            <td><a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a></td>
                            @if($role === 'admin')
                                <td>{{ $group->community->name }}</td>
                            @endif
                            <td>{{ $group->active_students_count }}</td>
                            <td>
                                <ul>
                                    @foreach ($group->users as $catechist)
                                        {!! '<li>' . $catechist->name . '</li>' !!}
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-right">
                                <x-button href="{{ route('groups.show', $group) }}" flat sm icon="eye" />
                                <x-button href="{{ route('groups.printableattendance', $group) }}" target="_blank" flat
                                    sm icon="table" />
                            </td>
                        </tr>
                    @empty
                        <x-empty />
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-paginate">
            {{ $groups->links() }}
        </div>
    </div>
    @if($can_create)
        @if ($showFormModal)
            <x-modal wire:model.defer="showFormModal" max-width="md">
                @livewire('group.form', ['group' => null, 'weekdays' => $weekdays]);
            </x-modal>
        @endif
    @endcan
</div>
