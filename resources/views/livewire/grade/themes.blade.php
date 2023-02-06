<div>
    <x-notifications />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Temas</h3>
            @can('theme_edit')
                <div class="card-tools">
                    <x-button wire:click="openModal('create')" sm flat primary label="Adicionar" />
                </div>
            @endcan
        </div>
    </div>
    <ul class="focusable">
        @forelse ($themes as $theme)
            <li x-data="{ expand: false }">
                <div x-show="!expand" @click="expand=true" class="focusable-item">
                    <span class="text-sm text-gray-600 font-medium">{{ $theme->sequence }}.</span> {{ $theme->title }}
                </div>
                <div x-show="expand" @click.outside="expand=false" class="focusable-focus">
                    <div class="flex border-b">
                        <div class="flex-1">
                            <h4><span class="text-sm text-gray-600 font-medium">{{ $theme->sequence }}.</span>
                                {{ $theme->title }}</h4>
                        </div>
                        @can('theme_edit')
                            <div class="px-2">
                                <x-button wire:click="openModal('edit', {{ $theme }})" sm flat icon="pencil-alt" />
                            </div>
                        @endcan
                    </div>
                    <div class="py-2">
                        <p class="text-justify">{{ $theme->description }}</p>
                    </div>
                </div>
            </li>
        @empty
            <div class="card card-body">
                <x-empty label="Nenhum tema cadastrado para esta etapa." />
            </div>
        @endforelse
    </ul>

    @can('theme_edit')
        <x-modal wire:model.defer="showModal" max-width="md">
            <div class="card w-full">
                <form wire:submit.prevent="submit">
                    <div class="card-header">
                        <h3 class="card-title py-2">{{ $modalTitle }}</h3>
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
                            <x-button x-on:click="close" sm flat label="Cancelar" />
                            <x-button type="submit" sm primary label="Salvar" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endcan
</div>
