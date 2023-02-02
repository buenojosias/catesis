<div>
    @if (!$student)
        <form wire:submit.prevent="submit">
            <div class="form-card mb-4">
                <div class="heading">
                    <h3>Informações pessoais</h3>
                    <p>As demais informações poderão ser inseridas nas próximas etapas.</p>
                    <x-errors class="shadow" />
                </div>
                <div class="body">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-4">
                            <x-input label="Nome *" placeholder="Informe o nome completo" wire:model.defer="name" required />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input type="date" wire:model.defer="birthday" label="Data de nascimento *" />
                            {{-- <x-datetime-picker label="Data de nascimento *" placeholder="Data de nascimento"
                                wire:model.defer="birthday" required without-tips without-time without-timezone :min="now()->subYears(18)"
                                :max="now()->subYears(5)" /> --}}
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
                            <x-input label="Naturalidade" placeholder="Cidade de nascimento"
                                wire:model.defer="naturalness" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-toggle md left-label="É batizado(a)" wire:model="has_baptism" />
                        </div>
                        @if ($has_baptism)
                            <div class="sm:col-span-2">
                                <x-input type="date" wire:model.defer="baptism_date" label="Data do batismo" />
                                {{-- <x-datetime-picker label="Data do batismo" placeholder="Data do batismo"
                                    wire:model.defer="baptism_date" without-tips without-time without-timezone
                                    :min="now()->subYears(18)" :max="now()" /> --}}
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
                <div class="footer">
                    <x-button type="submit" sm primary label="Salvar e continuar" />
                </div>
            </div>
        </form>
    @else
        <div class="card mb-2">
            <div class="card-body display">
                <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                    <div class="col-span-2">
                        <h4>Nome completo</h4>
                        <p>{{ $student->name }}</p>
                    </div>
                    <div>
                        <h4>Data de nascimento</h4>
                        <p>{{ Carbon\Carbon::parse($student->birthday)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h4>Idade</h4>
                        <p>{{ Carbon\Carbon::parse($student->birthday)->age }} anos</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
