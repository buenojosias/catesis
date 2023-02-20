<div class="md:max-w-3xl mx-auto">
    <x-errors class="mb-4 shadow" />
    <div x-data="{ password: false }" class="card mb-4">
        <div class="card-header">
            <h3 @click="password = true" class="card-title cursor-pointer">Alterar senha</h3>
        </div>
        <div x-show="password" class="card-body p-4">
            <div class="md:w-2/3 space-y-2">
                @if($this->catechist->id === auth()->user()->id)
                    <x-input type="password" label="Senha atual" wire:model.defer="current_password" />
                @endif
                <x-input type="password" label="Nova senha" wire:model.defer="new_password" />
                <x-input type="password" label="Confirmação de senha" wire:model.defer="confirmation_password" />
            </div>
        </div>
        <div x-show="password" class="card-footer justify-end space-x-2">
            <x-button @click="password = false" label="Cancelar" sm flat />
            <x-button wire:click="submitPassword" label="Salvar" sm primary />
        </div>
    </div>
    <div x-data="{ email: false }" class="card mb-4">
        <div class="card-header">
            <h3 @click="email = true" class="card-title cursor-pointer">Alterar e-mail</h3>
        </div>
        <div x-show="email" class="card-body p-4">
            <div class="md:w-2/3 space-y-2">
                <x-input type="email" label="E-mail atual" wire:model.defer="current_email" disabled />
                <x-input type="email" label="Novo e-mail" wire:model.defer="new_email" />
                <x-input type="email" label="Confirmação de e-mail" wire:model.defer="confirmation_email" />
            </div>
        </div>
        <div x-show="email" class="card-footer justify-end space-x-2">
            <x-button @click="email = false" label="Cancelar" sm flat />
            <x-button wire:click="submitEmail" label="Salvar" sm primary />
        </div>
    </div>
    @can('catechist_edit')
    <div x-data="{ roles: false }" class="card mb-4">
        <div @click="roles = true" class="card-header cursor-pointer">
            <h3 class="card-title">Funções de usuário</h3>
        </div>
        <div x-show="roles" class="card-body px-4">
            <ul>
                @foreach ($roles as $role)
                    <li class="flex justify-between py-1.5 border-b last:border-none">
                        <x-checkbox :label="$role['label']" wire:model.defer="catechist_roles" :value="$role['name']" />
                    </li>
                @endforeach
            </ul>
        </div>
        <div x-show="roles" class="card-footer justify-end space-x-2">
            <x-button @click="roles = false" label="Cancelar" sm flat />
            <x-button wire:click="submitRoles" label="Salvar" sm primary />
        </div>
    </div>
    {{-- <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Suspender acesso</h3>
        </div>
    </div> --}}
    @endcan
</div>
