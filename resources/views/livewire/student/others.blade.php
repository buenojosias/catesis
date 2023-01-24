<div class="sm:grid sm:grid-cols-2 sm:space-x-4">
    <x-notifications />
    <div>
        <div class="card mb-4">
            <div x-data="{ showform: false }" @close.window="showform = false" class="card-body display">
                <div x-show="!showform" class="flex justify-between items-center">
                    <div>
                        Status atual: <span class="font-semibold">{{ ucfirst($student->status) }}</span>
                    </div>
                    @can('student_edit')
                        <div @click="showform=true">
                            <x-button @click="showform=true" sm flat label="Alterar" />
                        </div>
                    @endcan
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
                                <option value="Transferido">Transferido</option>
                            </x-native-select>
                        </div>
                        <div class="flex items-center space-x-2">
                            <x-button type="submit" sm primary label="Salvar" />
                            <x-button @click="showform=false" sm flat label="Cancelar" />
                        </div>
                    </div>
                </form>
                @endcan
            </div>
        </div>
        @livewire('pastoral.related-list', ['model' => $student])
    </div>
    <div>
        @livewire('student.documents', ['student' => $student])
    </div>
</div>
