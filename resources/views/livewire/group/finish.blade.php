<div class="card mb-4">
    <form wire:submit.prevent="submitSituation">
        <div class="card-header">
            <h3 class="card-title">Marcar grupo como concluído</h3>
        </div>
        <div class="card-body table-responsive">
            <p class="p-4 border-b">Para marcar o grupo como concluído, informe a situação de cada catequizando.</p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Apr.</th>
                        <th>Repr.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td class="w-4 px-0">
                                <x-radio id="right-label" value="Aprovado"
                                    wire:model.defer="selectedSituation.{{ $student->id }}" />
                            </td>
                            <td class="w-4 px-0">
                                <x-radio id="right-label" value="Reprovado"
                                    wire:model.defer="selectedSituation.{{ $student->id }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <x-button wire:click="cancel" flat sm label="Cancelar" />
            <x-button type="submit" primary sm label="Concluir" />
        </div>
    </form>
</div>
