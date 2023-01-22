<div>
    <x-notifications />
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Endereço</h3>
        </div>
        @if ($address)
            <div class="card-body display">
                <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                    <div class="col-span-3">
                        <h4>Endereço</h4>
                        <p>{{ $address }}</p>
                    </div>
                    <div>
                        <h4>Complemento</h4>
                        <p>{{ $complement }}</p>
                    </div>
                    <div class="col-span-2">
                        <h4>Bairro</h4>
                        <p>{{ $district }}</p>
                    </div>
                    <div>
                        <h4>Cidade</h4>
                        <p>{{ $city }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="card-body py-3 text-center">
                <p class="my-1">Nenhuma informação de endereço cadastrada.</p>
                @can('student_edit')
                    <p class="my-1 font-semibold">Cadastrar agora</p>
                @endcan
                @cannot('student_edit')
                    <p class="my-1">Solicite ao coordenador ou assistente.</p>
                @endcan
            </div>
        @endif
        @can('student_edit')
            <div class="md:grid md:grid-cols-3 bg-gray-50 divide-x rounded-b">
                <div class="text-center font-semibold">
                    <a wire:click="openAddressModal()" class="block p-2 border-t cursor-pointer">Editar</a>
                </div>
                <div class="text-center font-semibold">
                    <a class="block p-2 border-t cursor-pointer">Editar</a>
                </div>
                <div class="text-center font-semibold">
                    <a class="block p-2 border-t cursor-pointer" wire:click="openRematriculationModal()">Fazer
                        rematrícula</a>
                </div>
            </div>
        @endcan
    </div>
    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contatos</h3>
                    @can('student_edit')
                        <div class="card-tools">
                            <x-button wire:click="openContactModal()" sm flat label="Editar" />
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <ul>
                        <li class="py-2 px-4 border-b">
                            <h4 class="text-sm font-medium text-gray-600">Telefone</h4>
                            <p class="font-medium text-gray-900">{{ $phone ?? 'Não informado' }}</p>
                        </li>
                        <li class="py-2 px-4 border-b">
                            <h4 class="text-sm font-medium text-gray-600">WhatsApp</h4>
                            <p class="font-medium text-gray-900">{{ $whatsapp ?? 'Não informado' }}</p>
                        </li>
                        <li class="py-2 px-4 border-b">
                            <h4 class="text-sm font-medium text-gray-600">E-mail</h4>
                            <p class="font-medium text-gray-900">{{ $email ?? 'Não informado' }}</p>
                        </li>
                        <li class="py-2 px-4 font-medium">
                            REDES SOCIAIS
                        </li>
                        <li class="py-2 px-4 border-b">
                            <h4 class="text-sm font-medium text-gray-600">Facebook</h4>
                            <p class="font-medium text-gray-900">{{ $facebook ?? 'Não informado' }}</p>
                        </li>
                        <li class="py-2 px-4">
                            <h4 class="text-sm font-medium text-gray-600">Instagram</h4>
                            <p class="font-medium text-gray-900">{{ $instagram ?? 'Não informado' }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            @livewire('student.kinship', ['student' => $student])
        </div>
    </div>
    @can('student_edit')
        <x-modal wire:model.defer="showContactModal" max-width="sm">
            <div class="card w-full">
                <form wire:submit.prevent="submitContact">
                    <div class="card-header">
                        <h3 class="card-title">Editar contatos</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="grid sm:grid-cols-4 gap-4">
                            <div class="sm:col-span-2">
                                <x-inputs.phone wire:model.defer="phone" label="Telefone"
                                    mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-inputs.phone wire:model.defer="whatsapp" label="WhatsApp"
                                    mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                            </div>
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="email" label="E-mail" />
                            </div>
                        </div>
                    </div>
                    <div class="block py-2 px-4 font-medium bg-gray-100">
                        REDES SOCIAIS
                    </div>
                    <div class="card-body display">
                        <div class="grid sm:grid-cols-4 gap-4">
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="facebook" label="Facebook" placeholder="https://facebook.com/usuario" />
                            </div>
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="instagram" label="Instagram" placeholder="Apenas nome do usuário" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button flat label="Cancelar" x-on:click="close" />
                            <x-button type="submit" primary label="Salvar" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
        <x-modal wire:model.defer="showAddressModal" max-width="md">
            <div class="card w-full">
                <form wire:submit.prevent="submitAddress">
                    <div class="card-header">
                        <h3 class="card-title">Editar endereço</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="grid sm:grid-cols-4 gap-4">
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="address" label="Endreço" />
                            </div>
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="complement" label="Complemento" cornerHint="Opcional" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-input wire:model.defer="district" label="Bairro" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-input wire:model.defer="city" label="Cidade" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button flat label="Cancelar" x-on:click="close" />
                            <x-button type="submit" primary label="Salvar" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endcan
</div>
