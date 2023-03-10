<div class="mb-4">
    <x-notifications />
    <x-dialog />
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
                                @if ($pastoral->community)
                                    <p class="text-sm font-medium text-gray-600">{{ $pastoral->community->name }}</p>
                                @endif
                            </div>
                            @if(($model->getTable() !== 'users' && auth()->user()->can('student_edit')) || ($model->getTable() === 'users' && (auth()->user()->can('catechist_edit') || $model->id === auth()->user()->id)))
                                <div class="flex items-center">
                                    <x-button wire:click="detach({{ $pastoral }})" xs flat icon="trash" />
                                </div>
                            @endif
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
            @if(($model->getTable() !== 'users' && auth()->user()->can('student_edit')) || ($model->getTable() === 'users' && (auth()->user()->can('catechist_edit') || $model->id === auth()->user()->id)))
                <div class="card-footer justify-end">
                    <x-button wire:click="openFormModal" label="Adicionar" sm flat primary />
                </div>
            @endif
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
                            @if ($communities && $communities->count() > 0)
                                <div>
                                    <x-native-select wire:model="community_id" label="Comunidade *">
                                        <option value="">Selecione</option>
                                        @foreach ($communities as $community)
                                            <option value="{{ $community->id }}">{{ $community->name }}</option>
                                        @endforeach
                                    </x-native-select>
                                </div>
                            @endif
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
                            @if ($pastoral_id)
                                <x-button type="submit" primary label="Salvar" />
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    @endif
</div>
