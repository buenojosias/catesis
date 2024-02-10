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
                        <option value="Todos">Todos</option>
                        <option value="Ativo">Ativos</option>
                        <option value="Crismado">Crismados</option>
                        <option value="Transferido">Transferidos</option>
                        <option value="Desistente">Desistentes</option>
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
                    @forelse ($students as $student)
                        <tr>
                            <td><a href="{{ route('students.show', $student) }}">{{ $student->name }}</a></td>
                            @hasrole('admin')
                                <td>{{ $student->community->name }}</td>
                            @endrole
                            <td>{{ $student->grade->title ?? 'Nenhuma' }}</td>
                            <td>
                                @if ($student->status === 'Ativo')
                                    <x-badge outline positive label="{{ $student->status }}" />
                                @else
                                    <x-badge outline warning label="{{ $student->status }}" />
                                @endif
                            </td>
                            <td class="text-right">
                                <x-button icon="eye" href="{{ route('students.show', $student) }}" flat sm />
                                {{-- @can('student_edit')
                                    <x-button href="{{ route('students.edit', $student) }}" flat primary sm
                                        icon="pencil" />
                                @endcan --}}
                            </td>
                        </tr>
                    @empty
                        <x-empty />
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-paginate">
            {{ $students->links() }}
        </div>
    </div>
</div>
