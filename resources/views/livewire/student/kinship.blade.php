<div>
    <x-dialog />
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Familiares</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Parentesco</th>
                        <th>Responsável</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kinships as $kinship)
                        <tr>
                            <td>{{ $kinship->name }}</td>
                            <td>{{ $kinship->pivot->title ?? '' }}</td>
                            <td>{{ $kinship->pivot->is_enroller ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                                    <x-input wire:model.defer="ks_name" label="Nome *" placeholder="Nome completo" required />
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
    @endcan

</div>
