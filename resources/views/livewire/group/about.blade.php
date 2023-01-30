<div>
    @if ($group->finished)
        <div class="alert info font-medium">
            Este grupo finalizou em {{ $group->end_date->format('d/m/Y') }}
        </div>
    @endif
    <div class="sm:grid sm:grid-cols-3 gap-4">
        <div class="col-span-2">
            <div class="card mb-4">
                <div class="card-body display">
                    <div class="sm:grid sm:grid-cols-3 space-y-3 sm:space-y-0 gap-4">
                        <div>
                            <h4>Etapa</h4>
                            <p>{{ $group->grade->title }}</p>
                        </div>
                        <div>
                            <h4>Ano</h4>
                            <p>{{ $group->year }}</p>
                        </div>
                        <div>
                            <h4>Catequizandos</h4>
                            <p>{{ $students_count }}</p>
                        </div>
                        <div class="col-span-3">
                            <h4>Catequista(s)</h4>
                            <p>
                                @forelse ($catechists as $catechist)
                                    {{ $catechist->name }}
                                    @if (!$loop->last)
                                        e
                                    @endif
                                @empty
                                    Nenhum catequista adicionado
                                @endforelse
                            </p>
                        </div>
                        <div>
                            <h4>Dia e horário dos encontros</h4>
                            <p>{{ $weekdays[$group->weekday] }} | {{ $group->time->format('H:i') }}</p>
                        </div>

                        <div>
                            <h4>Data inicial</h4>
                            <p>{{ $group->start_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h4>Data final</h4>
                            <p>{{ $group->end_date ? $group->end_date->format('d/m/Y') : '' }}</p>
                        </div>
                        @if ($role === 'admin')
                            <div class="col-span-3">
                                <h4>Comunidade</h4>
                                <p>{{ $group->community->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div>
            <ul class="space-y-2">
                <li>
                    <x-button md white icon="printer" label="Imprimir ficha" class="w-full shadow" />
                </li>
                <li>
                    <x-button href="{{ route('groups.printableattendance', $group) }}" target="_blank" md white
                        icon="table" label="Imprimir chamada" class="w-full shadow" />
                </li>
                @if (($group->community_id === $community_id && $can_edit) || $role === 'admin')
                    <li>
                        <x-button wire:click="openCatechistsModal" md white icon="users" label="Gereciar catequistas"
                            class="w-full shadow" />
                    </li>
                    <li>
                        <x-button wire:click="openFormModal" md white icon="pencil-alt" label="Editar"
                            class="w-full shadow" />
                    </li>
                @endif
            </ul>
        </div>
    </div>
    @if('can_edit')
        @if ($showFormModal)
            <x-modal wire:model.defer="showFormModal" max-width="md">
                @livewire('group.form', ['group' => $group, 'weekdays' => $weekdays]);
            </x-modal>
        @endif
        @if ($showCatechistsModal)
            <x-modal wire:model.defer="showCatechistsModal" max-width="md">
                <div class="card w-full">
                    <div class="card-header">
                        <h3 class="card-title">Catequistas do grupo</h3>
                        <div class="card-tools">
                            <x-button flat sm icon="x" wire:click="hideCatechistsModal" />
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach ($catechists as $catechist)
                                    <tr>
                                        <td>{{ $catechist->name }}</td>
                                        <td class="w-4">
                                            <x-button wire:click="detachCatechist({{ $catechist }})" flat xs negative
                                                icon="trash" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-1.5 bg-gray-100 text-sm font-semibold">
                        ADICIONAR CATEQUISTA
                    </div>
                    <div class="card-body display">
                        <div class="flex items-center space-x-2">
                            <div class="grow">
                                <x-native-select wire:model="selected_catechist">
                                    <option value="">Selecione</option>
                                    @foreach ($avaliable_catechists as $catechist)
                                        <option value="{{ $catechist->id }}">{{ $catechist->name }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                            <div>
                                <x-button wire:click="syncCatechist" primary label="Salvar" />
                            </div>
                        </div>
                    </div>
                </div>
            </x-modal>
        @endif
    @endif
</div>
