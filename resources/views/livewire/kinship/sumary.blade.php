<div>
    <x-notifications />
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Informações pessoais</h3>
        </div>
        <div class="card-body display">
            <div class="sm:grid sm:grid-cols-2 md:grid-cols-3 md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div>
                    <h4>Nome</h4>
                    <p>{{ $name }}</p>
                </div>
                <div>
                    <h4>Data de nascimento</h4>
                    <p>{{ Carbon\Carbon::parse($birthday)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h4>Profissão</h4>
                    <p>{{ $profession ?? 'Não informada' }}</p>
                </div>
                <div>
                    <h4>Estado civil</h4>
                    <p>{{ $marital_status ?? 'Não informado' }}</p>
                </div>
                <div>
                    <h4>Religião</h4>
                    <p>{{ $religion }}</p>
                </div>
                <div>
                    <h4>É batizado(a)?</h4>
                    <p>{{ $has_baptism ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Faz catequese?</h4>
                    <p>{{ $catechizing ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Tem Sacramento da Eucaristia?</h4>
                    <p>{{ $has_eucharist ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Tem Sacramento da Crisma?</h4>
                    <p>{{ $has_chrism ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Frequenta a igreja?</h4>
                    <p>{{ $attends_church ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>É dizimista?</h4>
                    <p>{{ $is_tither ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Toca algum instrumento musical?</h4>
                    <p>{{ $musical_instrument }}</p>
                </div>
            </div>
        </div>
        @can('student_edit')
            <div class="card-footer">
                <x-button flat wire:click="openEditProfileModal()" label="Editar" />
            </div>
        @endcan
    </div>
    @can('student_edit')
        <x-modal wire:model.defer="showEditProfileModal">
            <div class="card w-full">
                <form wire:submit.prevent="submitProfile">
                    <div class="card-header">
                        <h3 class="card-title">Editar informações</h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="grid sm:grid-cols-3 gap-4">
                            <div class="sm:col-span-2">
                                <x-input label="Nome *" placeholder="Informe o nome completo" wire:model.defer="name"
                                    required />
                            </div>
                            <div>
                                <x-datetime-picker label="Data de nascimento *" placeholder="Data de nascimento"
                                    wire:model.defer="birthday" without-tips without-time without-timezone :min="now()->subYears(90)"
                                    :max="now()->subYears(2)" required />
                            </div>
                            <div>
                                <x-input label="Profissão" placeholder="Profissão" wire:model.defer="profession" />
                            </div>
                            <div>
                                <x-native-select wire:model.defer="marital_status" label="Estado civil *">
                                    <option value="">Selecione</option>
                                    <option value="Solteiro(a)">Solteiro(a)</option>
                                    <option value="Noivo(a)">Noivo(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Divorciado(a)">Divorciado(a)</option>
                                    <option value="Viúvo(a)">Viúvo(a)</option>
                                    <option value="Outro">Outro</option>
                                </x-native-select>
                            </div>
                            <div>
                                <x-input wire:model.defer="religion" label="Religião" />
                            </div>
                            <div>
                                <x-toggle md label="É batizado(a)?" wire:model.defer="has_baptism" />
                            </div>
                            <div>
                                <x-toggle md label="Faz catequese?" wire:model.defer="catechizing" />
                            </div>
                            <div>
                                <x-toggle md label="Tem Eucaristia?" wire:model.defer="has_eucharist" />
                            </div>
                            <div>
                                <x-toggle md label="Tem Crisma?" wire:model.defer="has_chrism" />
                            </div>
                            <div>
                                <x-toggle md label="Frequenta a igreja?" wire:model.defer="attends_church" />
                            </div>
                            <div>
                                <x-toggle md label="É dizimista?" wire:model.defer="is_tither" />
                            </div>
                            <div>
                                <x-input wire:model.defer="musical_instrument" label="Toca instrumento musical?"
                                    placeholder="Se sim, qual?" />
                            </div>
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
