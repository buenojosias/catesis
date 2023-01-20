<div>
    <x-notifications />
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Temas</h3>
            @can('theme_edit')
                <div class="card-tools">
                    <x-button wire:click="openModal('create')" flat sm icon="plus" />
                </div>
            @endcan
        </div>
        <div class="card-body">
            <ul>
                @forelse ($themes as $theme)
                    <li x-data="{ show: false }" class="py-1.5 px-4 border-b last:border-none">
                        <div class="flex space-x-4 items-center">
                            <div class="grow">
                                <a @click="show = !show" class="block cursor-pointer">
                                    <span class="font-medium">{{ $theme->sequence }}.</span> {{ $theme->title }}
                                </a>
                            </div>
                            @can('theme_edit')
                                <div>
                                    <x-button wire:click="openModal('edit', {{ $theme }})" sm flat
                                        icon="pencil-alt" />
                                </div>
                            @endcan
                        </div>
                        <div x-show="show" class="py-2 pl-4 text-sm">
                            {{ $theme->description }}
                        </div>
                    </li>
                @empty
                    <x-empty label="Nenhum tema cadastrado para esta etapa." />
                @endforelse
            </ul>
        </div>
    </div>
    @can('theme_edit')
        <x-modal wire:model.defer="showModal">
            <div class="card w-full">
                <form wire:submit.prevent="submit">
                    <div class="card-header">
                        <h3 class="card-title">{{ $modalTitle }}</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="mb-4">
                            <x-input wire:model.defer="title" label="Título" />
                        </div>
                        <div>
                            <x-textarea wire:model.defer="description" rows="6" label="Descrição" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-end gap-x-4">
                            <x-button flat label="Cancelar" x-on:click="close" />
                            <x-button type="submit" primary label="Salvar" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endcan
</div>
