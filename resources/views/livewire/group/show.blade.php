<div>
    <x-notifications />
    <div class="card mb-4">
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
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
                <div>
                    <h4>Dia e horário dos encontros</h4>
                    <p>{{ $group->weekday }} | {{ $group->time->format('H:i') }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Catequista(s)
                        <x-button wire:click="openCatechistsModal" flat xs icon="pencil" />
                    </h4>
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
                    <h4>Data inicial</h4>
                    <p>{{ $group->start_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h4>Data final</h4>
                    <p>{{ $group->end_date ? $group->end_date->format('d/m/Y') : '' }}</p>
                </div>
                @hasrole('admin')
                    <div class="col-span-4">
                        <h4>Comunidade</h4>
                        <p>{{ $group->community->name }}</p>
                    </div>
                @endhasrole
            </div>
        </div>
        @if (
            $group->community_id === auth()->user()->community_id ||
                auth()->user()->hasRole('admin'))
            <div class="md:grid md:grid-cols-4 bg-gray-50 divide-x rounded-b">
                <div class="text-center font-semibold">
                    <a class="block p-2 border-t cursor-pointer" wire:click="showStudents">Exibir catequizandos</a>
                </div>
                <div class="text-center font-semibold">
                    <a class="block p-2 border-t cursor-pointer" wire:click="showEncounters">Exibir encontros</a>
                </div>
                @can('group_edit')
                    <div class="text-center font-semibold">
                        <a wire:click="openFormModal" class="block p-2 border-t cursor-pointer">Editar</a>
                    </div>
                @endcan
                @cannot('group_edit')
                    <div class="text-center font-semibold">
                        <a class="block p-2 border-t cursor-pointer" wire:click="showThemes">Exibir temas</a>
                    </div>
                @endcannot
                <div class="text-center font-semibold">
                    <a href="{{ route('groups.printableattendance', $group) }}" target="_blank"
                        class="block p-2 border-t cursor-pointer">Emitir chamada</a>
                </div>
            </div>
        @endif
    </div>
    @if ($students)
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Catequizandos</h3>
                <div class="card-tools">
                    <x-button flat sm icon="x" wire:click="hideStudents" />
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Status</th>
                            <th>Faltas</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td><a href="{{ route('students.show', $student) }}">{{ $student->name }}</a></td>
                                <td>{{ $student->age }} anos</td>
                                <td>{{ $student->status }}</td>
                                <td>
                                    {{-- {{ $student->encounters->count() }} --}}
                                </td>
                                <td class="text-right">
                                    <x-button href="{{ route('students.show', $student) }}" flat primary sm
                                        icon="eye" />
                                    @can('student_edit')
                                        <x-button href="{{ route('students.edit', $student) }}" flat primary sm
                                            icon="pencil" />
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <x-empty label="Nenhum catequizando adicionado." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($encounters)
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Encontros</h3>
                <div class="card-tools">
                    @can('group_edit')
                        <x-button outline primary xs label="Adicionar" wire:click="openEncounterModal('create')" />
                    @endcan
                    <x-button flat sm icon="x" wire:click="hideEncounters" />
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Método</th>
                            <th>Tema</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($encounters as $encounter)
                            <tr>
                                <td><a href="#">{{ $encounter->date->format('d/m/Y') }}</a></td>
                                <td>{{ $encounter->method }}</td>
                                <td>{{ $encounter->theme->title ?? '' }}</td>
                                <td class="text-right">
                                    <x-button href="{{ route('groups.encounter', [$group, $encounter]) }}" flat primary
                                        sm icon="eye" />
                                    @can('group_edit')
                                        <x-button wire:click="openEncounterModal('edit', {{ $encounter }})" flat primary
                                            sm icon="pencil" />
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <x-empty label="Nenhum encontro programado." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($themes)
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Temas</h3>
                <div class="card-tools">
                    <x-button flat sm icon="x" wire:click="hideThemes" />
                </div>
            </div>
            <ul>
                @forelse ($themes as $theme)
                    <li x-data="{ show: false }" class="py-2 px-4 border-b last:border-none">
                        <div class="flex space-x-4 items-center">
                            <div class="grow">
                                <a @click="show = !show" class="block cursor-pointer">
                                    <span class="font-medium">{{ $theme->sequence }}.</span> {{ $theme->title }}
                                </a>
                            </div>
                        </div>
                        <div x-show="show" class="py-2 pl-4 text-sm">
                            {{ $theme->description }}
                        </div>
                    </li>
                @empty
                    <x-empty label="Nenhum tema cadastrado para esta etapa." />
                @endforelse
            </ul>
        </div>
    @endif
    @can('group_edit')
        @if ($showFormModal)
            <x-modal wire:model.defer="showFormModal" max-width="md">
                @livewire('group.form', ['group' => $group]);
            </x-modal>
        @endif
        @if ($showEncounterModal)
            <x-modal wire:model.defer="showEncounterModal" max-width="md">
                <form wire:submit.prevent="submitEncounter">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $method === 'create' ? 'Adicionar encontro' : 'Editar encontro' }}
                            </h3>
                        </div>
                        <div class="card-body display">
                            <x-errors class="mb-4 shadow" />
                            <div class="grid grid-cols-2 space-y-3 space-y-0 gap-4">
                                <div>
                                    <x-datetime-picker wire:model.defer="edit_encounter.date" label="Data"
                                        placeholder="Data do encontro" without-tips without-timezone without-time />
                                </div>
                                <x-native-select wire:model.defer="edit_encounter.method" label="Modalidade">
                                    <option value="">Selecione</option>
                                    <option value="presencial">Presencial</option>
                                    <option value="familiar">Familiar</option>
                                </x-native-select>
                                <div class="col-span-2">
                                    <x-native-select wire:model.defer="edit_encounter.theme_id" label="Tema">
                                        <option value="">Selecione</option>
                                        @foreach ($edit_themes as $theme)
                                            <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                                        @endforeach
                                    </x-native-select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex justify-between gap-x-4">
                                <x-button flat label="Cancelar" x-on:click="close" />
                                <x-button type="submit" primary label="Salvar" />
                            </div>
                        </div>
                    </div>
                </form>
            </x-modal>
        @endif
        @if ($catechistsModal)
            <x-modal wire:model.defer="catechistsModal" max-width="md">
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
                                            <x-button wire:click="detachCatechist({{$catechist}})" flat xs negative icon="trash" />
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
                                <x-button wire:click="syncCatechist" label="Salvar" />
                            </div>
                        </div>
                    </div>
                </div>

            </x-modal>
        @endif
    @endcan

</div>
