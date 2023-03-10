<div>
    <x-notifications />
    @if ($student->status != 'Ativo')
        <div class="alert warning">
            O status atual do catequizando é <span class="font-semibold">{{ $student->status }}</span>.
        </div>
    @endif
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
                    <p>{{ Carbon\Carbon::parse($birthday)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h4>Idade</h4>
                    <p>{{ Carbon\Carbon::parse($birthday)->age }} anos</p>
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
                    <p>{{ $baptism_date ? Carbon\Carbon::parse($baptism_date)->format('d/m/Y') : '---' }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Igreja do batismo</h4>
                    <p>{{ $baptism_church ?? '---' }}</p>
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
                    <p>{{ $school ?? '---' }}</p>
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
                    <h4>Status</h4>
                    <p>{{ $student->status }}</p>
                </div>
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
                <a href="{{ route('students.show', [$student, 'comentarios']) }}" class="block p-2 border-t cursor-pointer">Comentários</a>
            </div>
            <div class="text-center font-semibold">
                <a href="{{ route('student.print', $student) }}" target="_blank" class="block p-2 border-t cursor-pointer">Imprimir ficha</a>
            </div>
        </div>
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
                        <div class="grid sm:grid-cols-4 gap-4">
                            <div class="sm:col-span-4">
                                <x-input label="Nome *" placeholder="Informe o nome completo" wire:model.defer="name"
                                    required />
                            </div>
                            <div class="sm:col-span-2">
                                <x-input type="date" wire:model.defer="birthday" label="Data de nascimento *" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-native-select label="Sexo *" wire:model.defer="gender" required>
                                    <option value="">Selecione</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outro">Outro</option>
                                </x-native-select>
                            </div>
                            <div class="sm:col-span-4">
                                <x-input label="Naturalidade" placeholder="Cidade/UF"
                                    wire:model.defer="naturalness" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-toggle md left-label="É batizado(a)" wire:model="has_baptism" />
                            </div>
                            @if ($has_baptism)
                                <div class="sm:col-span-2">
                                    <x-input type="date" wire:model.defer="baptism_date" label="Data do batismo" />
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
                        <div class="flex justify-end gap-x-4">
                            <x-button label="Cancelar" sm flat x-on:click="close" />
                            <x-button type="submit" sm primary label="Salvar" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endcan
</div>
