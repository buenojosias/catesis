<div class="card">
    <x-dialog />
    <form wire:submit.prevent="submitRematriculation">
        <div class="card-header">
            <h3 class="card-title">Rematrícula</h3>
        </div>
        <div class="card-body display">
            <div class="mb-4">
                <h4>Catequizando(a)</h4>
                <p>{{ $student->name }}</p>
            </div>
            <x-errors class="mb-4 shadow" />
            <div>
                <x-native-select wire:model.defer="group" label="Grupo *" required>
                    <option value="">Selecione</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->grade->title }} - {{ $group->year }}</option>
                    @endforeach
                </x-native-select>
            </div>
            <div class="my-4">
                <x-native-select wire:model.defer="kinship" label="Familiar representante *"
                    hint="Se o familiar não estiver disponível, é necessário vinculá-lo na guia Familiares." required>
                    <option value="">Selecione</option>
                    @foreach ($kinships as $kinship)
                        <option value="{{ $kinship->id }}">{{ $kinship->name }} ({{ $kinship->pivot->title ?? '' }})
                        </option>
                    @endforeach
                </x-native-select>
            </div>
            <div>
                <x-textarea wire:model.defer="comment" label="Comentário"
                    placeholder="Se preferir, você pode escrever uma observação sobre o(a) catequizando(a)." />
            </div>
        </div>
        <div class="card-footer">
            <div class="flex justify-between gap-x-4">
                <x-button flat label="Cancelar" x-on:click="close" />
                <x-button type="submit" primary label="Concluir" />
            </div>
        </div>
    </form>
</div>
