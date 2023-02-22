<div class="md:grid md:grid-cols-5 gap-4">
    <div class="col-span-3">
        <div x-data="{ showDetails: false }" class="card mb-4">
            <div class="card-body display">
                <div class="md:grid md:grid-cols-2 space-y-3 md:space-y-0 gap-4">
                    <div class="col-span-2">
                        <h4>Nome completo</h4>
                        <p>{{ $name }}</p>
                    </div>
                    <div>
                        <h4>Data de nascimento</h4>
                        <p>{{ Carbon\Carbon::parse($birthday)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h4>Estado civil</h4>
                        <p>{{ $marital_status ?? 'Não informado' }}</p>
                    </div>
                    @hasrole('admin')
                        <div class="col-span-4">
                            <h4>Comunidade</h4>
                            <p>{{ $community->name ?? '' }}</p>
                        </div>
                    @endhasrole
                    <div class="col-span-2">
                        <h4>Naturalidade</h4>
                        <p>{{ $naturalness ?? 'Não informada' }}</p>
                    </div>
                    <div class="col-span-2">
                        <h4>Formação acadêmica</h4>
                        <p>{{ $scholarity ?? 'Não informada' }}</p>
                    </div>
                </div>
            </div>
            <div x-show="!showDetails" class="card-body pb-2">
                <div @click="showDetails = true" class="py-1 px-4 bg-gray-100 font-semibold cursor-pointer">
                    <h4>Carregar mais informações</h4>
                </div>
            </div>
            <div x-show="showDetails" class="card-body display">
                <h4>Há quanto tempo é catequista?</h4>
                <p>{{ $catechist_from ? Carbon\Carbon::parse($catechist_from)->diffForHumans(null, true) : 'Não informado' }}</p>
                <h4 class="mt-4">Como foi seu chamado para ser catequista?</h4>
                {{ $catechist_invitation ?? 'Sem resposta' }}
                <h4 class="mt-4">Como prepara seus encontros de catequese?</h4>
                {{ $encounter_preparation ?? 'Sem resposta' }}
            </div>
            @if (auth()->user()->can('catechist_edit') || $catechist->id === auth()->user()->id)
                <div class="card-footer justify-end">
                    <x-button wire:click="openEditProfileModal" label="Editar" flat sm />
                </div>
            @endif
        </div>
        @if (auth()->user()->can('catechist_edit') || $catechist->id === auth()->user()->id)
        <div x-data="{ 'showCharacteristics': false }" class="card mb-4">
            <div class="card-header">
                <h3 @click="showCharacteristics = !showCharacteristics" wire:click="loadCharacteristics" class="card-title cursor-pointer">Características interpessoais</h3>
            </div>
            <div x-show="showCharacteristics" class="card-body py-2 px-4">
                @if ($catechist->id === auth()->user()->id)
                    <p class="mb-2 text-sm">O "ser" do catequista revela um rosto humano e cristão.<br>
                        Dentro de um <span class="font-semibold">ideal a ser conquistado</span>,
                        assinale somente as características com as quais se identifica.</p>
                @endif
                @if ($characteristics)
                    <ul>
                        @foreach ($characteristics as $characteristic)
                            <li
                                class="py-1 flex items-center space-x-2 {{ $catechist->id !== auth()->user()->id ? 'border-b last:border-none' : '' }}">
                                @if ($catechist->id === auth()->user()->id)
                                    <x-checkbox :label="$characteristic['title']" wire:model.defer="catechistCharacteristics" wire:click="syncCharacteristc({{$characteristic['id']}})" :value="$characteristic['id']" />
                                @else
                                    <div class="w-4">
                                        <x-icon name="check"
                                            class="w-4 h-4 {{ in_array($characteristic->id, $catechistCharacteristics) ? 'text-green-500' : 'text-gray-100' }}"
                                            solid />
                                    </div>
                                    <div>{{ $characteristic->title }}</div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-span-2">
        @if ($catechist->hasRole('catechist'))
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $groups->count() > 1 ? 'Grupos atuais' : 'Grupo atual' }}
                </h3>
            </div>
            <div class="card-body">
                @forelse ($groups->where('year', date('Y'))->where('finished', false) as $group)
                    <div class="flex justify-between flex-wrap p-4 border-b last:border-none">
                        <div class="font-semibold">
                            <a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a>
                        </div>
                        <div>
                            <x-badge outline secondary
                                label="{{ $weekdays[$group->weekday] }}, {{ $group->time->format('H:i') }}" />
                        </div>
                        <div class="basis-full text-sm">{{ $group->students_count }} catequizandos</div>
                    </div>
                @empty
                    <div class="p-4 text-center text-sm font-semibold">
                        Nenhum grupo adicionado.
                    </div>
                @endforelse
            </div>
        </div>
        @endif
        @livewire('pastoral.related-list', ['model' => $catechist])
    </div>

    @if (auth()->user()->can('catechist_edit') || $catechist->id === auth()->user()->id)
    <x-modal wire:model.defer="showEditProfileModal">
        <div class="card w-full">
            <form wire:submit.prevent="submitProfile">
                <div class="card-header">
                    <h3 class="card-title">Editar informações</h3>
                </div>
                <div class="card-body display">
                    <x-errors class="mb-4 shadow" />
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-4">
                            <x-input label="Nome *" placeholder="Informe o nome completo" wire:model.defer="name"
                                required />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input type="date" wire:model.defer="birthday" label="Data de nascimento *" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-native-select label="Estado civil" wire:model.defer="marital_status">
                                <option value="">Selecione</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Viúvo(a)">Viúvo(a)</option>
                                <option value="Outro">Outro</option>
                            </x-native-select>
                        </div>
                        <div class="sm:col-span-4">
                            <x-input label="Naturalidade" placeholder="Cidade/UF"
                                wire:model.defer="naturalness" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-native-select label="Escolaridade" wire:model.defer="scholarity">
                                <option value="">Selecione</option>
                                <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                                <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
                                <option value="Cursando Ensino Médio">Cursando Ensino Médio</option>
                                <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                <option value="Cursando Ensino Superior">Cursando Ensino Superior</option>
                                <option value="Ensino Superior Completo">Ensino Superior Completo</option>
                                <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                            </x-native-select>
                        </div>
                        <div class="sm:col-span-2">
                            <x-input type="date" wire:model.defer="catechist_from" label="Catequista desde:" hint="Data aproximada" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-textarea wire:model.defer="catechist_invitation" rows="2" label="Como foi seu chamado para ser catequista?" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-textarea wire:model.defer="encounter_preparation" rows="2" label="Como você prepara seus encontros de catequese?" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button label="Cancelar" sm flat x-on:click="close" />
                        <x-button type="submit" sm primary label="Salvar" />
                    </div>
                </div>
            </form>
        </div>
    </x-modal>
    @endif

</div>
