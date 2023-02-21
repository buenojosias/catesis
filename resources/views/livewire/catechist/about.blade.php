<div class="md:grid md:grid-cols-5 gap-4">
    <div class="col-span-3">
        <div x-data="{ showDetails: false }" class="card mb-4">
            <div class="card-body display">
                <div class="md:grid md:grid-cols-2 space-y-3 md:space-y-0 gap-4">
                    <div class="col-span-2">
                        <h4>Nome completo</h4>
                        <p>{{ $catechist->name }}</p>
                    </div>
                    <div>
                        <h4>Data de nascimento</h4>
                        <p>{{ $catechist->profile->birthday->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h4>Estado civil</h4>
                        <p>{{ $catechist->profile->marital_status ?? 'Não informado' }}</p>
                    </div>
                    @hasrole('admin')
                        <div class="col-span-4">
                            <h4>Comunidade</h4>
                            <p>{{ $catechist->community->name ?? '' }}</p>
                        </div>
                    @endhasrole
                    <div class="col-span-2">
                        <h4>Naturalidade</h4>
                        <p>{{ $catechist->profile->naturalness ?? 'Não informada' }}</p>
                    </div>
                    <div class="col-span-2">
                        <h4>Formação acadêmica</h4>
                        <p>{{ $catechist->profile->scholarity ?? 'Não informada' }}</p>
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
                <p>{{ $catechist->profile->catechist_from ?? 'Não informado' }}</p>
                <h4 class="mt-4">Como foi seu chamado para ser catequista?</h4>
                {{ $catechist->profile->catechist_invitation ?? 'Sem resposta' }}
                <h4 class="mt-4">Como prepara seus encontros de catequese?</h4>
                {{ $catechist->profile->encounter_preparation ?? 'Sem resposta' }}
            </div>
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
        @livewire('pastoral.related-list', ['model' => $catechist])
    </div>
</div>
