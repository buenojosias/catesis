<div class="sm:grid sm:grid-cols-3 sm:space-x-6">
    <x-notifications />
    <div class="col-span-2 mb-4 sm:px-2">
        @if ($community_name)
            <h2 class="mb-4 border-b border-gray-300 text-2xl font-semibold text-slate-900">{{ $community_name }}</h2>
        @endif
        <div>
            <ul class="focusable">
                @foreach ($pastorals as $key => $pastoral)
                    <li x-data="{ expand: false }">
                        <div x-show="!expand" @click="expand=true" class="focusable-item">
                            {{ $pastoral->name }}</div>
                        <div x-show="expand" @click.outside="expand=false" class="focusable-focus">
                            <div class="flex">
                                <div class="flex-1">
                                    <h4>{{ $pastoral->name }}</h4>
                                    @if ($pastoral->coordinator)
                                        <p class="font-semibold">
                                            Coordenador(a): {{ $pastoral->coordinator }}
                                        </p>
                                    @endif
                                    @if ($pastoral->encounters)
                                        <p class="font-semibold">
                                            Encontros: {{ $pastoral->encounters }}
                                        </p>
                                    @endif
                                </div>
                                @if (
                                    $pastoral->user_id === auth()->user()->id ||
                                        auth()->user()->hasRole('admin'))
                                    <div class="px-2">
                                        <x-button wire:click="openFormModal('edit', {{ $pastoral }})" sm flat
                                            icon="pencil" />
                                    </div>
                                @endif
                            </div>
                            @if ($pastoral->students->count() > 0)
                                <div class="header">
                                    CATEQUIZANDOS PARTICIPANTES
                                </div>
                                <ul class="text-sm">
                                    @foreach ($pastoral->students as $student)
                                        <li class="list-item">
                                            <div class="sm:flex-1 font-semibold text-gray-900">{{ $student->name }}
                                            </div>
                                            <div class="sm:text-right text-gray-600">
                                                {{ session('role') === 'admin' ? $student->community->name : $student->grade->title }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if ($pastoral->kinships->count() > 0)
                                <div class="header">
                                    FAMILIARES PARTICIPANTES
                                </div>
                                <ul class="text-sm">
                                    @foreach ($pastoral->kinships as $kinship)
                                        <li class="sm:flex mx-4 py-2 border-b last:border-none">
                                            <div class="font-semibold text-gray-900">{{ $kinship->name }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div>
        <x-button wire:click="openFormModal('create')" label="ADICIONAR MOVIMENTO/PASTORAL" primary
            class="mb-4 block w-full" />
        @if ($communities && $communities->count() > 0)
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
        @endif
    </div>
    @if ($showFormModal)
        <x-modal wire:model.defer="showFormModal" max-width="md">
            <form wire:submit.prevent="submit" class="w-full">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $method === 'create' ? 'Adicionar' : 'Editar' }} movimento ou
                            pastoral
                        </h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="flex flex-col space-y-4">
                            @if ($communities->count() > 0)
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
                                        <x-input label="Comunidade" corner-hint="Somente leitura"
                                            value="{{ $communities->where('id', $form['community_id'])->first()->name }}"
                                            readonly />
                                    </div>
                                @endif
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
                            <x-button x-on:click="close" sm flat label="Cancelar" />
                            <x-button type="submit" sm primary label="Salvar" />
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    @endif
</div>
