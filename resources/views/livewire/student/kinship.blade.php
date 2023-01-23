<div>
    <x-dialog />
    <x-notifications />
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Familiares</h3>
        </div>
        <div class="card-body">
            <ul>
                @forelse ($kinships as $kinship)
                    <li class="flex space-x-2 py-2 px-4 border-b">
                        <div class="grow">
                            <div class="flex">
                                <h4 class="text-sm font-medium text-gray-600 grow">{{ $kinship->name }}
                                    ({{ $kinship->pivot->title ?? '' }})
                                </h4>
                                @if (@$kinship->pivot->is_enroller)
                                    <x-badge outline sm label="Responsável" />
                                @endif
                            </div>
                            <p class="font-medium text-gray-900">
                                {{ $kinship->contact->phone ?? '' }}
                                @if (@$kinship->contact->phone && @$kinship->contact->whatsapp)
                                    •
                                @endif
                                {{ $kinship->contact->whatsapp ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <x-dropdown>
                                <x-dropdown.item href="{{ route('kinships.show', $kinship) }}" icon="eye"
                                    label="Detalhes" />
                                @can('student_edit')
                                    <x-dropdown.item wire:click="openEditModal({{ $kinship }})" icon="pencil-alt"
                                        label="Alterar vínculo" />
                                    <x-dropdown.item wire:click="detachKinship({{ $kinship }})" separator
                                        icon="user-remove" label="Desvincular" />
                                @endcan
                            </x-dropdown>
                        </div>
                    </li>
                @empty
                    <x-empty label="Nenhum familiar vinculado." />
                @endforelse
            </ul>
        </div>
        <div class="card-footer justify-end space-x-2">
            @can('student_edit')
                <x-button onclick="$openModal('kinshipCreateModal')" primary sm label="Adicionar familiar" />
            @endcan
        </div>
    </div>
    @can('student_edit')
        <x-modal wire:model.defer="kinshipCreateModal">
            <form wire:submit.prevent="kinshipSubmit">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Adicionar familiar</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <span>
                            Como você deseja adicionar o membro familiar?
                        </span>
                        <div class="grid sm:grid-cols-4 gap-4 mt-4">
                            <div class="sm:col-span-2">
                                <x-radio id="sync" label="Vincular familiar cadastrado" wire:model="option"
                                    value="sync" />
                                <div class="pl-6 text-sm text-gray-500">
                                    Você poderá selecionar um familiar já cadastrado no banco de dados, inclusive de outras
                                    comunidades.
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <x-radio id="create" label="Cadastrar novo familiar" wire:model="option"
                                    value="create" />
                                <div class="pl-6 text-sm text-gray-600">
                                    O membro será automaticamente vinculado ao(à) catequizando(a) selecionado(a).
                                </div>
                            </div>
                            @if ($option === 'sync')
                                <div class="sm:col-span-4">
                                    <x-select label="Buscar familiar" wire:model.defer="ks_id"
                                        placeholder="Comece a digitar" :async-data="route('api.kinships')" option-label="name"
                                        option-value="id" />
                                </div>
                            @endif
                            @if ($option === 'create')
                                <div class="sm:col-span-4">
                                    <x-input wire:model.defer="ks_name" label="Nome *" placeholder="Nome completo"
                                        required />
                                </div>
                                <div class="sm:col-span-2">
                                    <x-datetime-picker label="Data de nascimento" placeholder="Data de nascimento *"
                                        wire:model.defer="ks_birth" without-tips without-time :max="now()->subYears(2)" required />
                                </div>
                            @endif
                            @if ($option)
                                <div class="sm:col-span-2">
                                    <x-native-select label="Grau de parentesco *" wire:model.defer="ks_title" required>
                                        <option value="">Selecione</option>
                                        @foreach ($titles as $title)
                                            <option>{{ $title }}</option>
                                        @endforeach
                                    </x-native-select>
                                </div>
                                @if ($option === 'sync')
                                    <div class="sm:col-span-2"></div>
                                @endif
                                <div class="sm:col-span-2">
                                    <x-toggle md left-label="Mora junto" wire:model.defer="ks_live_together" />
                                </div>
                                <div class="sm:col-span-2">
                                    <x-toggle md left-label="É responsável pelo(a) catequizando(a)"
                                        wire:model.defer="ks_is_enroller" />
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button sm flat label="Cancelar" x-on:click="close" />
                            @if ($option)
                                <x-button sm type="submit" primary label="Salvar" />
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>

        <x-modal wire:model.defer="kinshipEditModal" max-width="sm">
            <form wire:submit.prevent="submitEdit" class="w-full">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Alterar vínculo de familiar</h3>
                    </div>
                    <div class="card-body display flex flex-col space-y-4">
                        <x-errors class="mb-4 shadow" />
                        <div>
                            <x-input label="Nome do familiar" value="{{ $kinshipName }}" readonly />
                        </div>
                        <div>
                            <x-native-select label="Grau de parentesco *" wire:model.defer="kinshipForm.pivot.title"
                                required>
                                @foreach ($titles as $title)
                                    <option>{{ $title }}</option>
                                @endforeach
                            </x-native-select>
                        </div>
                        <div class="flex">
                            <div class="grow">
                                <x-label label="Mora junto" />
                            </div>
                            <div>
                                <x-toggle md wire:model="kinshipForm.pivot.live_together" />
                            </div>
                        </div>
                        <div class="flex">
                            <div class="grow">
                                <x-label label="É responsável" />
                            </div>
                            <div>
                                <x-toggle md wire:model="kinshipForm.pivot.is_enroller" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button flat label="Cancelar" x-on:click="close" />
                            <x-button type="submit" primary label="Salvar" />
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    @endcan
</div>
