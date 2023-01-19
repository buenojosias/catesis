<div>
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
        <div class="md:grid md:grid-cols-3 bg-gray-50 divide-x rounded-b">
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
        </div>
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
                                <td>xxx</td>
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
                            <x-empty />
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
                                <td>{{ $encounter->theme->title }}</td>
                                <td class="text-right">
                                    <x-button href="#" flat primary sm icon="eye" />
                                    <x-button href="#" flat sm icon="table" />
                                    @can('encounter_edit')
                                        <x-button href="#" flat primary sm icon="pencil" />
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <x-empty />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @can('group_edit')
        @if ($showFormModal)
            <x-modal wire:model.defer="showFormModal" max-width="md">
                @livewire('group.form', ['group' => $group]);
            </x-modal>
        @endif
    @endcan

</div>
