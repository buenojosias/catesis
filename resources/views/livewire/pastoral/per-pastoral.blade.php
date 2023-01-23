<div class="sm:grid sm:grid-cols-3 sm:space-x-6">
    <x-notifications />
    <div class="col-span-2 mb-4">
        <h2 class="mb-4 border-b border-gray-300 text-2xl font-semibold text-slate-900">{{ $community_name }}</h2>
        @foreach ($pastorals as $key => $pastoral)
            <div x-data="{ expand: false }" class="card mb-2">
                <div class="card-header">
                    <h3 @click="expand = !expand" class="card-title block w-full cursor-pointer">
                        {{ $pastoral->name }}
                    </h3>
                    @if (
                        $pastoral->user_id === auth()->user()->id ||
                            auth()->user()->hasRole('admin'))
                        <div class="card-tools">
                            <x-button wire:click="openFormModal('edit', {{ $pastoral }})" flat xs icon="pencil" />
                        </div>
                    @endif
                </div>
                <div x-show="expand" class="card-body">
                    @if ($pastoral->coordinator)
                        <div class="py-1 px-4">
                            Coordenador(a): {{ $pastoral->coordinator }}
                        </div>
                    @endif
                    @if ($pastoral->encounters)
                        <div class="py-1 px-4">
                            Encontros: {{ $pastoral->encounters }}
                        </div>
                    @endif
                    @if ($pastoral->students->count() > 0)
                        <div class="py-2 px-4 bg-gray-100 font-semibold">
                            CATEQUIZANDOS PARTICIPANTES
                        </div>
                        <table class="table">
                            <tbody>
                                @foreach ($pastoral->students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td class="text-right">{{ $student->community->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if ($pastoral->kinships->count() > 0)
                        <div class="py-2 px-4 bg-gray-100 font-semibold">
                            FAMILIARES PARTICIPANTES
                        </div>
                        <table class="table">
                            <tbody>
                                @foreach ($pastoral->kinships as $kinship)
                                    <tr>
                                        <td>{{ $kinship->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div>
        <x-button wire:click="openFormModal('create')" primary label="ADICIONAR MOVIMENTO/PASTORAL"
            class="mb-4 block w-full" />
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comunidades</h3>
            </div>
            <div class="body table-responsive">
                <table class="table">
                    <tbody>
                        @foreach ($communities as $community)
                            <tr>
                                <td wire:click="selectCommunity({{ $community->id }})" class="cursor-pointer">
                                    {{ $community->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($showFormModal)
        <x-modal wire:model.defer="showFormModal" max-width="sm">
            <form wire:submit.prevent="submit" class="w-full">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $method === 'create' ? 'Adicionar' : 'Editar' }} movimento ou
                            pastoral</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="flex flex-col space-y-4">
                            @if ($method === 'create')
                                <div>
                                    <x-native-select wire:model.defer="form.community_id" label="Comunidade *">
                                        <option value="">Selecione</option>
                                        @foreach ($communities as $community)
                                            <option value="{{ $community->id }}">{{ $community->name }}</option>
                                        @endforeach
                                    </x-native-select>
                                </div>
                            @else
                                <div>
                                    <x-input label="Comunidade" corner-hint="Somente leitura" value="{{ $communities->where('id', $form['community_id'])->first()->name }}" readonly />
                                </div>
                            @endif
                            <div>
                                <x-input wire:model.defer="form.name" label="Nome do movimento/pastoral *" />
                            </div>
                            <div>
                                <x-input wire:model.defer="form.coordinator" label="Nome da coordenador(a)" />
                            </div>
                            <div>
                                <x-input wire:model.defer="form.encounters" label="Dia e horário dos encontros" />
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
</div>
