<div>
    <x-notifications />
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
                                <x-input wire:model.defer="facebook" label="Facebook"
                                    placeholder="https://facebook.com/usuario" />
                            </div>
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="instagram" label="Instagram"
                                    placeholder="Apenas nome do usuário" />
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
