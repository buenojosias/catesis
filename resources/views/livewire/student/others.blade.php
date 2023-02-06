<div class="sm:grid sm:grid-cols-2 sm:space-x-4">
    <x-notifications />
    <div>
        <div x-data="{ showform: false }" @close.window="showform = false" class="card mb-4">
            <div class="card-body display">
                <div x-show="!showform" class="flex justify-between items-center">
                    <div>
                        Status atual: <span class="font-semibold">{{ ucfirst($student->status) }}</span>
                    </div>
                </div>
                @can('student_edit')
                    <form wire:submit.prevent="changeStatus">
                        <div x-show="showform" class="flex flex-wrap justify-between">
                            <div class="w-full text-sm font-semibold">
                                Selecione o novo status:
                            </div>
                            <div class="grow mr-2">
                                <x-native-select wire:model.defer="status">
                                    <option value="Ativo">Ativo</option>
                                    <option value="Crismado">Crismado</option>
                                    <option value="Desistente">Desistente</option>
                                </x-native-select>
                            </div>
                            <div class="flex items-center space-x-2">
                                <x-button @click="showform=false" flat label="Cancelar" />
                                <x-button type="submit" primary label="Salvar" />
                            </div>
                        </div>
                    </form>
                @endcan
            </div>

            @can('student_edit')
                <div x-show="!showform" class="card-footer flex justify-between">
                    <div class="flex-1">
                        <x-button @click="showform=true" sm flat label="Alterar" class="w-full" />
                    </div>
                    @if ($transfer)
                        <div class="flex-1">
                            <x-button href="{{ route('student.transfer.print', [$student, $transfer]) }}" target="_blank" sm flat label="Imprimir ficha de transferência" class="w-full" />
                        </div>
                    @else
                        <div class="flex-1">
                            <x-button wire:click="openTransferModal" sm flat label="Gerar transferência" class="w-full" />
                        </div>
                    @endif
                </div>
            @endcan

        </div>
        @livewire('pastoral.related-list', ['model' => $student])
    </div>
    <div>
        @livewire('student.documents', ['student' => $student])
    </div>

    @if ($transferModal)
        <x-modal wire:model.defer="transferModal" max-width="md">
            @livewire('student.transfer', ['student' => $student])
        </x-modal>
    @endif

</div>
