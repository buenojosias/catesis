<div>
    <x-notifications />
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Movimentos e pastorais</h3>
        </div>
        <div class="card-body">
            @if ($showList)
                <ul>
                    @forelse ($pastorals as $pastoral)
                        <li class="flex py-2 px-4 border-b">
                            <div class="grow">
                                <h4 class="font-medium text-gray-900">{{ $pastoral->name }}</h4>
                                <p class="text-sm font-medium text-gray-600">{{ $pastoral->community->name }}</p>
                            </div>
                            <div class="flex items-center">
                                <x-button xs flat icon="trash" />
                            </div>
                        </li>
                    @empty
                        <x-empty label="Nenhum movimento ou pastoral vinculado." />
                    @endforelse
                </ul>
            @else
                <div class="py-3 px-4 text-center font-semibold text-sm">
                    <a wire:click="loadList" class="cursor-pointer">Carregar</a>
                </div>
            @endif
        </div>
        @if ($pastorals)
            @can('student_edit')
                <div class="card-footer">
                    <x-button sm outline wire:click="openFormModal" label="Adicionar movimento/pastoral" />
                </div>
            @endcan
        @endif
    </div>
    @if ($showFormModal)
        <x-modal wire:model.defer="showFormModal" max-width="sm">
            <form wire:submit.prevent="syncPastoral" class="w-full">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vincular movimento ou pastoral</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="flex flex-col space-y-4">
                            <div>
                                <x-native-select wire:model="community_id" label="Comunidade *">
                                    <option value="">Selecione</option>
                                    @foreach ($communities as $community)
                                        <option value="{{ $community->id }}">{{ $community->name }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                            <div>
                                <x-native-select wire:model="pastoral_id" label="Movimento ou pastoral *">
                                    <option value="">Selecione</option>
                                    @foreach ($community_pastorals as $pastoral)
                                        <option value="{{ $pastoral->id }}">{{ $pastoral->name }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button flat label="Cancelar" x-on:click="close" />
                            @if ($community_id && $pastoral_id)
                                <x-button type="submit" primary label="Salvar" />
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    @endif
</div>
