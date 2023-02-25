<div>
    <div class="card">
        <div class="card-body responsive-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Responsável</th>
                        <th width="1%">Status</th>
                        <th width="1%"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrollments as $enroll)
                        <tr>
                            <td>{{ $enroll->student->name }}</td>
                            <td>{{ $enroll->student->birthday->age }}</td>
                            <td>{{ $enroll->kinship->name }}</td>
                            <td>
                                @if ($enroll->status === 'Confirmado')
                                    <x-badge outline positive label="{{ $enroll->status }}" />
                                @else
                                    <x-badge outline warning label="{{ $enroll->status }}" />
                                @endif
                            </td>
                            <td class="flex gap-1">
                                @if ($enroll->status !== 'Confirmado')
                                    <x-button wire:click="openConfirmModal({{ $enroll->id }})" icon="check" outline
                                        positive xs />
                                    <x-button icon="x" outline negative xs />
                                @endif
                            </td>
                        </tr>
                    @empty
                        <x-empty label="Nenhuma inscrição realizada" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($enrollmentData)
        <x-modal wire:model.defer="confirmationEnrollmentModal" max-width="md">
            <div class="card">
                <form wire:submit.prevent="submitConfirmation">
                    <div class="card-header">
                        <h3 class="card-title">Confirmar inscrição</h3>
                    </div>
                    <div class="card-body display">
                        <div class="mb-4">
                            <h4>Catequizando(a)</h4>
                            <p>{{ $student['name'] }}</p>
                        </div>
                        <div class="mb-4">
                            <h4>Responsável</h4>
                            <p>{{ $kinship['name'] }}</p>
                        </div>
                        <x-errors class="mb-4 shadow" />
                        <div>
                            <x-native-select wire:model.defer="group" label="Grupo *" required>
                                <option value="">Selecione</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->grade->title }} -
                                        {{ $group->year }}</option>
                                @endforeach
                            </x-native-select>
                        </div>
                        <div class="my-4">
                            <x-inputs.currency label="Pagamento" prefix="R$" thousands="." decimal=","
                                wire:model.defer="payment" />
                        </div>
                        <div>
                            <x-textarea wire:model.defer="comment" label="Comentário"
                                placeholder="Se preferir, você pode escrever uma observação sobre o(a) catequizando(a)." />
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button x-on:click="close" sm flat label="Cancelar" />
                            <x-button type="submit" sm primary label="Concluir" />
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endif

</div>
