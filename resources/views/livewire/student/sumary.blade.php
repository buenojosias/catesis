<div>
    <x-notifications />
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações pessoais</h3>
        </div>
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div class="col-span-2">
                    <h4>Nome completo</h4>
                    <p>{{ $name }}</p>
                </div>
                <div>
                    <h4>Data de nascimento</h4>
                    <p>{{ Carbon\Carbon::parse($birth)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h4>Idade</h4>
                    <p>{{ Carbon\Carbon::parse($birth)->age }} anos</p>
                </div>
            </div>
        </div>
        <div class="card-header bg-gray-50">
            <h3 class="card-title">Informações adicionais</h3>
        </div>
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div>
                    <h4>É batizado(a)?</h4>
                    <p>{{ $has_baptism ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Data do batismo</h4>
                    <p>{{ $baptism_date ? Carbon\Carbon::parse($baptism_date)->format('d/m/Y') : '' }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Igreja do batismo</h4>
                    <p>{{ $baptism_church }}</p>
                </div>
                <div>
                    <h4>Os pais são casados?</h4>
                    <p>{{ $married_parents ? 'Sim' : 'Não' }}</p>
                </div>
                <div>
                    <h4>Sexo</h4>
                    <p>{{ $gender }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Naturalidade</h4>
                    <p>{{ $naturalness }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Problemas de saúde</h4>
                    <p>{{ $health_problems ?? 'Nenhum' }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Escola onde estuda</h4>
                    <p>{{ $school }}</p>
                </div>
            </div>
        </div>
        <div class="card-header bg-gray-50">
            <h3 class="my-2">Informações catequéticas</h3>
        </div>
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                @hasrole('admin')
                    <div class="col-span-4">
                        <h4>Comunidade</h4>
                        <p>{{ $community->name }}</p>
                    </div>
                @endhasrole
                <div>
                    <h4>Etapa atual</h4>
                    <p>{{ $grade->title ?? 'Nenhuma' }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Catequista(s)</h4>
                    <p>
                        @forelse ($catechists as $catechist)
                            {{ $catechist->name }}
                            @if (!$loop->last)
                                e
                            @endif
                        @empty
                            <p></p>
                        @endforelse
                    </p>
                </div>
            </div>
        </div>

        <div class="md:grid md:grid-cols-3 bg-gray-50 divide-x rounded-b">
            <div class="text-center font-semibold">
                @can('student_edit')
                    <a wire:click="openEditProfileModal" class="block p-2 border-t cursor-pointer">Editar</a>
                @endcan
            </div>
            <div class="text-center font-semibold">
                <a wire:click="showComments" class="block p-2 border-t cursor-pointer">Comentários</a>
            </div>
            <div class="text-center font-semibold">
                @can('student_edit')
                    <a class="block p-2 border-t cursor-pointer" wire:click="openRematriculationModal()">Fazer
                        rematrícula</a>
                @endcan
            </div>
        </div>
    </div>
    {{-- @if ($rematriculationModal) --}}
    @can('student_edit')
        <x-modal wire:model.defer="rematriculationModal">
            @livewire('student.rematriculation', ['student' => $student])
        </x-modal>
    @endcan
    {{-- @endif --}}
    @can('student_edit')
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
                                <x-datetime-picker label="Data de nascimento *" placeholder="Data de nascimento"
                                    wire:model.defer="birth" without-tips without-time without-timezone :min="now()->subYears(18)"
                                    :max="now()->subYears(5)" required />
                            </div>
                            <div class="sm:col-span-2">
                                <x-native-select label="Sexo *" wire:model.defer="gender" required>
                                    <option value="">Selecione</option>
                                    <option value="male">Masculino</option>
                                    <option value="female">Feminino</option>
                                    <option value="other">Outro</option>
                                </x-native-select>
                            </div>
                            <div class="sm:col-span-4">
                                <x-input label="Naturalidade" placeholder="Cidade de nascimento"
                                    wire:model.defer="naturalness" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-toggle md left-label="É batizado(a)" wire:model="has_baptism" />
                            </div>
                            @if ($has_baptism)
                                <div class="sm:col-span-2">
                                    <x-datetime-picker label="Data do batismo" placeholder="Data do batismo"
                                        wire:model.defer="baptism_date" without-tips without-time without-timezone
                                        :min="now()->subYears(18)" :max="now()" />
                                </div>
                                <div class="sm:col-span-4">
                                    <x-input label="Onde foi batizado(a)" placeholder="Nome da igreja"
                                        wire:model.defer="baptism_church" />
                                </div>
                            @endif
                            <div class="sm:col-span-2">
                                <x-toggle md left-label="Os pais são casados na igreja" wire:model="married_parents" />
                            </div>
                            <div class="sm:col-span-4">
                                <x-input label="Onde estuda?" placeholder="Nome da escola/colégio"
                                    wire:model.defer="school" />
                            </div>
                            <div class="sm:col-span-4">
                                <x-input label="Possui problema de saúde?" placeholder="Se sim, descreva"
                                    wire:model.defer="health_problems" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button flat label="Cancelar" x-on:click="close" />
                            <x-button type="submit" primary label="Salvar" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endcan
</div>
