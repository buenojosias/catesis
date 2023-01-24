<div x-data="{ 'form': false }" class="mb-2">
    <div x-show="!form" @click="form = true" class="card flex p-4 cursor-pointer">
        <div class="flex-1 font-semibold">
            Responsável
        </div>
        @if ($kinship)
            <div>
                <x-icon name="check-circle" class="w-6 h-6 text-green-800" />
            </div>
        @endif
    </div>
    <div x-show="form" @close.window="form = false">
        @if (!$kinship)
            <form wire:submit.prevent="submit" class="form-card">
                <div class="heading">
                    <h3>Responsável</h3>
                    <p>Cadastre ou vincule o principal familiar do catequizando. Você poderá cadastrar e vincular outros familiares posteriormente.</p>
                    <x-errors class="shadow" />
                </div>
                <div class="body">
                    <span>
                        Como você deseja adicionar o membro responsável?
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
                                O membro será automaticamente vinculado ao(à) catequizando(a).
                            </div>
                        </div>
                        @if ($option === 'sync')
                            <div class="sm:col-span-4">
                                <x-select label="Buscar familiar" wire:model.defer="ksid"
                                    placeholder="Comece a digitar" :async-data="route('api.kinships')" option-label="name"
                                    option-value="id" />
                            </div>
                        @endif
                        @if ($option === 'create')
                            <div class="sm:col-span-4">
                                <x-input wire:model.defer="name" label="Nome *" placeholder="Nome completo *" required />
                            </div>
                            <div class="sm:col-span-2">
                                <x-datetime-picker label="Data de nascimento" placeholder="Data de nascimento *"
                                    wire:model.defer="birth" without-tips without-time :max="now()->subYears(2)" required />
                            </div>
                        @endif
                        @if ($option)
                            <div class="sm:col-span-2">
                                <x-native-select label="Grau de parentesco *" wire:model.defer="title" required>
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
                                <x-toggle md left-label="Mora junto" wire:model.defer="live_together" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-toggle md left-label="É responsável pelo(a) catequizando(a)"
                                    wire:model.defer="is_enroller" />
                            </div>
                            @if ($option === 'create')
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
                                <div class="sm:col-span-4">
                                    <x-input wire:model.defer="facebook" label="Facebook" />
                                </div>
                                <div class="sm:col-span-4">
                                    <x-input wire:model.defer="instagram" label="Instagram" />
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="footer">
                    <x-button type="submit" sm primary label="Continuar" />
                </div>
            </form>
        @else
            <div class="card mb-4">
                <div class="card-header cursor-pointer" @click="form = false">
                    <h3 class="card-title">Responsável</h3>
                </div>
                <div class="card-body display">
                    <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                        <div class="col-span-4">
                            <h4>Nome</h4>
                            <p>{{ $kinship->name }}</p>
                        </div>
                        <div>
                            <h4>Grau de parentesco</h4>
                            <p>{{ $title }}</p>
                        </div>
                        <div>
                            <h4>É responsável</h4>
                            <p>{{ $is_enroller ? 'Sim' : 'Não' }}</p>
                        </div>
                        <div>
                            <h4>Mora junto</h4>
                            <p>{{ $live_together ? 'Sim' : 'Não' }}</p>
                        </div>
                    </div>
                    <div class="mt-4 md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                        <div>
                            <h4>Telefone</h4>
                            <p>{{ $contact->phone }}</p>
                        </div>
                        <div>
                            <h4>WhatsApp</h4>
                            <p>{{ $contact->whatsapp }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>E-mail</h4>
                            <p>{{ $contact->email }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>Facebook</h4>
                            <p>{{ $contact->facebook }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>Instagram</h4>
                            <p>{{ $contact->instagram }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
