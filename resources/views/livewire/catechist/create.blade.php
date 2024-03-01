<div>
    <x-notifications />
    @if (!$catechist)
        <form wire:submit.prevent="submit">
            <x-errors class="mb-4 shadow" />
            <div class="form-card mb-4">
                <div class="heading">
                    <h3>Informações pessoais</h3>
                </div>
                <div class="body">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="name" label="Nome" placeholder="Informe o nome completo" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input type="date" wire:model.defer="birthday" label="Data de nascimento *" />
                            {{-- <x-datetime-picker without-time without-tips without-timezone wire:model.defer="birthday"
                                :max="now()->subYears(13)" label="Data de nascimento" placeholder="Selecione" /> --}}
                        </div>
                        <div class="sm:col-span-2">
                            <x-native-select wire:model.defer="marital_status" label="Estado civil">
                                <option value="">Selecione</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Viúvo(a)">Viúvo(a)</option>
                                <option value="Outro">Outro</option>
                            </x-native-select>
                        </div>
                        @if($auth_role === 'super-admin')
                            <div class="sm:col-span-4">
                                <x-native-select wire:model.defer="parish_id" label="Paróquia" required>
                                    <option value="">Selecione</option>
                                    @foreach ($parishes as $parish)
                                        <option value="{{ $parish->id }}">{{ $parish->name }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                        @endif
                        @if(in_array($auth_role, ['admin','super-admin']))
                            <div class="sm:col-span-4">
                                <x-native-select wire:model.defer="community_id" label="Comunidade" required>
                                    <option value="">Selecione</option>
                                    @foreach ($communities as $community)
                                        <option value="{{ $community->id }}">{{ $community->name }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="heading border-t">
                    <h3>Conta</h3>
                    <p>Insira aqui os dados de acesso do catequista à plataforma. O campo função definirá o nível de
                        acesso do mesmo.</p>
                </div>
                <div class="body sm:border-t">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="email" label="E-mail" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input wire:model.defer="password" type="password" label="Senha" placeholder="••••••" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input wire:model.defer="password_confirmation" type="password" label="Confirmação da senha"
                                placeholder="••••••" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-native-select wire:model.defer="role" label="Função">
                                <option value="">Selecione</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->label }}</option>
                                @endforeach
                            </x-native-select>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <x-button sm primary type="submit" primary label="Salvar e continuar" />
                </div>
            </div>
        </form>
    @else
        <div class="card mb-4">
            <div class="card-body display">
                <div class="md:grid md:grid-cols-2 space-y-3 md:space-y-0 gap-4">
                    <div>
                        <h4>Nome</h4>
                        <p>{{ $catechist->name }}</p>
                    </div>
                    <div>
                        <h4>Data de nascimento</h4>
                        <p>{{ Carbon\Carbon::parse($profile->birthday)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h4>Estado civil</h4>
                        <p>{{ $profile->marital_status }}</p>
                    </div>
                    <div>
                        <h4>E-mail</h4>
                        <p>{{ $catechist->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($catechist)
        @livewire('catechist.create.contact', ['catechist' => $catechist])
    @endif
</div>
