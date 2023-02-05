<div x-data="{showConfirm: false}" class="card w-full">
    <form wire:submit.prevent="submitTransfer">
        <div class="card-header">
            <h3 class="card-title">Gerar transferência</h3>
        </div>
        <div class="card-body display">
            <x-errors class="mb-4 shadow" />
            <div class="mb-4">
                <h4>Catequizando(a)</h4>
                <p>{{ $student->name }}</p>
            </div>
            <div class="mb-4">
                <h4>Grupo atual</h4>
                <p>{{ $group->grade->title ?? 'Nenhum' }}</p>
            </div>
            <div>
                <x-native-select wire:model.defer="kinship_id" label="Familiar solicitante" hint="Selecione o familiar que está solicitando a transferência" required>
                    <option value="">Selecione</option>
                    @foreach ($kinships as $kinship)
                        <option value="{{ $kinship->id }}">{{ $kinship->name }} ({{ $kinship->pivot->title ?? '' }})
                        </option>
                    @endforeach
                </x-native-select>
            </div>
            <div class="my-4 text-sm">
                Ao confirmar a transferência, o(a) catequizando(a) será removido(a) do grupo atual e seu status mudará para Transferido.
            </div>
            <div>
                <x-checkbox @click="showConfirm = !showConfirm" label="Estou ciente." />
            </div>
        </div>
        <div class="card-footer">
            <div class="flex justify-between gap-x-2">
                <x-button x-on:click="close" sm flat label="Cancelar" />
                <x-button x-show="showConfirm" type="submit" sm primary label="Concluir" />
            </div>
        </div>
    </form>
</div>
