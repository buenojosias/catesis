<div x-data="{ 'show': false }">
    <x-notifications />
    <div @click="show=true" wire:click="loadData" class="card-header cursor-pointer">
        <h3 class="card-title">Alterar função</h3>
    </div>
    <div x-show="show" @close.window="show=false" class="card-body p-4">
        @if ($roles)
        <form wire:submit.prevent="submit">
            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
                <div class="flex-1">
                    <x-native-select wire:model.defer="role">
                        <option value="">Selecione</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->label }}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div class="flex justify-end">
                    <x-button @click="show=false" sm flat label="Cancelar" />
                    <x-button type="submit" sm primary label="Salvar" />
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
