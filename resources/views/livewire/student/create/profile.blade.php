<div>
    @if (!$student)
        <form wire:submit.prevent="submit">
            <div class="form-card mb-4">
                <div class="heading">
                    <h3>Informações básicas</h3>
                    <p>As demais informações poderão ser inseridas nas próximas etapas.</p>
                    <x-errors class="shadow" />
                </div>
                <div class="body">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-4">
                            <x-input label="Nome" placeholder="Informe o nome completo" wire:model.defer="name" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-datetime-picker label="Data de nascimento" placeholder="Data de nascimento"
                                wire:model.defer="birth" without-tips without-time without-timezone :min="now()->subYears(18)"
                                :max="now()->subYears(5)" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-native-select label="Sexo" wire:model.defer="gender">
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
                            <x-input label="Onde estuda?" placeholder="Nome da escola/colégio" cornerHint="Opcional"
                                wire:model.defer="school" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-input label="Possui problema de saúde?" placeholder="Se sim, descreva"
                                cornerHint="Opcional" wire:model.defer="health_problems" />
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <x-button type="submit" primary label="Salvar e continuar" />
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
                        <p>{{ Carbon\Carbon::parse($student->birth)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h4>Idade</h4>
                        <p>{{ Carbon\Carbon::parse($student->birth)->age }} anos</p>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
