<div>
    <div class="card">
        <div class="card-header relative" x-data="{ filters: false }">
            <div class="card-search">
                <x-input type="text" right-icon="search" wire:model.debounce.500ms="search"
                    placeholder="Buscar catequizando(a)" />
            </div>
            <div class="card-tools">
                <x-button flat icon="filter" @click="filters = !filters" />
            </div>
            <div x-show="filters" @click.outside="filters = false" class="filters">
                <div>
                    <x-native-select label="Status" wire:model="status">
                        <option value="">Todos</option>
                        <option value="ativo">Ativos</option>
                        <option value="crismado">Crismados</option>
                        <option value="desistente">Desistentes</option>
                    </x-native-select>
                </div>
                @hasanyrole(['admin', 'coordinator', 'secretary'])
                    <div>
                        <x-native-select label="Etapa" wire:model="grade">
                            <option value="">Todas</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->title }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                @endhasanyrole
                @role('admin')
                    <div>
                        <x-native-select label="Comunidade" wire:model="community">
                            <option value="">Todas</option>
                            @foreach ($communities as $community)
                                <option value="{{ $community->id }}">{{ $community->name }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                @endrole
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        @hasrole('admin')
                            <th>Comunidade</th>
                        @endhasrole
                        <th>Etapa atual</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('students.show', $student) }}">{{ $student->name }}</a></td>
                            @hasrole('admin')
                                <td>{{ $student->community->name }}</td>
                            @endrole
                            <td>{{ $student->grade->title ?? 'Nenhuma' }}</td>
                            <td>
                                <span
                                    class="px-2 pt-0.5 py-1 rounded text-xs font-semibold text-white bg-green-700">{{ $student->status }}</span>
                            </td>
                            <td class="text-right">
                                <x-button icon="eye" flat red sm
                                    wire:click="openStudentModal({{ $student->id }})" />
                                <x-button icon="eye" href="{{ route('students.show', $student) }}" flat primary sm
                                    />
                                @can('student_edit')
                                    <x-button href="{{ route('students.edit', $student) }}" flat primary sm
                                        icon="pencil" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-paginate">
            {{ $students->links() }}
        </div>
    </div>

    @if ($simpleModal)
        <x-modal wire:model.defer="simpleModal">
            <x-card title="Consent Terms">
                <p class="text-gray-600">
                    {{ $selectedStudent ?? null }}
                </p>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="I Agree" />
                    </div>
                </x-slot>
            </x-card>
        </x-modal>
    @endif
</div>
