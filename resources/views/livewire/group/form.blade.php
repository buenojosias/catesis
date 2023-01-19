<div>
    <x-dialog />
    <form wire:submit.prevent="submit">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $cardTitle }}</h3>
            </div>
            <div class="card-body display">
                <div class="grid grid-cols-2 space-y-3 space-y-0 gap-4">
                    <div>
                        <x-native-select wire:model.defer="year" label="Ano">
                            <option value="">Selecione</option>
                            @foreach ($years as $year)
                                <option>{{ $year }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                    @if (!$group)
                    <div>
                        <x-native-select wire:model.defer="grade_id" label="Etapa" readonly>
                            <option value="">Selecione</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->title }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                    @else
                        <x-input value="{{ $grades->where('id', $grade_id)->first()->title }}" label="Etapa" readonly />
                    @endif
                    <x-native-select wire:model.defer="weekday" label="Dia dos encontros">
                        <option value="">Selecione</option>
                        <option value="1">Domingo</option>
                        <option value="2">Segunda-feira</option>
                        <option value="3">Terça-feira</option>
                        <option value="4">Quarta-feira</option>
                        <option value="5">Quinta-feira</option>
                        <option value="6">Sexta-feira</option>
                        <option value="7">Sábado</option>
                    </x-native-select>
                    <div>
                        <x-time-picker wire:model.defer="time" label="Horário dos encontros" placeholder="Selecione"
                            format="24" interval="30" />
                    </div>
                    <div>
                        <x-datetime-picker wire:model.defer="start_date" label="Data de início" placeholder="Selecione"
                            without-tips without-timezone without-time />
                    </div>
                    <div>
                        <x-datetime-picker wire:model.defer="end_date" label="Data de encerramento"
                            placeholder="Opcional por enquanto" without-tips without-timezone without-time />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="flex justify-between gap-x-4">
                    <x-button flat label="Cancelar" x-on:click="close" />
                    <x-button type="submit" primary label="Salvar" />
                </div>
            </div>
        </div>
    </form>
</div>
