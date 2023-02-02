<div>
    <x-modal wire:model.defer="modalShow" max-width="md">
        <div class="card w-full">
            @if ($eventData)
                <div class="card-header">
                    <h3 class="card-title">{{ $eventData['title'] }} {{ $eventData['title'] }}</h3>
                    <div class="card-tools my-1">
                        <x-button @click="close" icon="x" sm flat />
                    </div>
                </div>
                <div class="card-body mb-2">
                    <ul>
                        <li class="py-1 px-4">
                            <h4 class="text-sm font-medium text-gray-600">Data
                                {{ $eventData['start_time'] ? 'e hora' : '' }}
                                {{ $eventData['end_date'] ? 'de início' : '' }}
                            </h4>
                            <p class="font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($eventData['start_date'])->format('d/m/Y') }}
                                {{ $eventData['start_time'] ? ' - '.\Carbon\Carbon::createFromFormat('H:i:s', $eventData['start_time'])->format('H\hi') : '' }}
                            </p>
                        </li>
                        @if ($eventData['end_date'])
                            <li class="py-1 px-4">
                                <h4 class="text-sm font-medium text-gray-600">Data de encerramento</h4>
                                <p class="font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($eventData['end_date'])->format('d/m/Y') }}
                                    {{ $eventData['end_time'] ? ' - '.\Carbon\Carbon::createFromFormat('H:i:s', $eventData['end_time'])->format('H\hi') : '' }}
                                </p>
                            </li>
                        @endif
                        <li class="py-1 px-4">
                            <h4 class="text-sm font-medium text-gray-600">Detalhes</h4>
                            <p class="text-sm text-gray-900">{{ $eventData['description'] }}</p>
                        </li>
                        @if ($eventData['user'])
                            <li class="py-1 px-4">
                                <h4 class="text-sm font-medium text-gray-600">Cadastrado por</h4>
                                <p class="text-sm text-gray-900">{{ $eventData['user']['name'] }}</p>
                            </li>
                        @endif
                    </ul>
                </div>
                {{-- @if ($eventData['user_id'] === auth()->user()->id ||
    auth()->user()->hasRole('admin'))
                    <div class="card-footer justify-end">
                        <x-button sm flat label="Editar" />
                        <x-button sm flat negative label="Excluir" />
                    </div>
                @endif --}}
            @endif
        </div>
    </x-modal>
</div>
