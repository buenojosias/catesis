<div>
    @if ($canRegisterAttendance)
        @if ($studentsWithoutAttendence->where('status', 'Ativo')->count() > 0)
            <div class="card mb-4">
                <form wire:submit.prevent="submitAttendance">
                    <div class="card-header">
                        <h3 class="card-title">Registrar chamada</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @foreach ($studentsWithoutAttendence->where('status', 'Ativo') as $key => $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td class="w-4 px-0">
                                            <x-radio id="right-label" label="C" value="C"
                                                wire:model.defer="selectedAttendance.{{ $student->id }}" />
                                        </td>
                                        <td class="w-4 px-0">
                                            <x-radio id="right-label" label="F" value="F"
                                                wire:model.defer="selectedAttendance.{{ $student->id }}" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <x-button wire:click="resetAttendance" flat sm label="Resetar" />
                        <x-button type="submit" primary sm label="Salvar" />
                    </div>
                </form>
            </div>
        @endif
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Registro de frequência</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <tbody>
                    @forelse ($studentsWithAttendence->where('status', 'Ativo') as $key => $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td
                                class="font-semibold text-center {{ $student->pivot->attendance === 'F' ? 'text-red-700' : '' }} w-4">
                                {{ $student->pivot->attendance }}
                            </td>
                            @can('attendance_edit')
                                <td class="w-8">
                                    <x-button wire:click="openChangeModal({{ $student }})" outline xs label="Alterar" />
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <x-empty label="Nenhum registro lançado." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @can('attendance_edit')
        @if ($showChangeModal)
            <x-modal wire:model.defer="showChangeModal" max-width="md">
                <div class="card w-full">
                    <div class="card-header">
                        <h3 class="card-title">Alterar registro</h3>
                        <div class="card-tools">
                            <x-button flat sm icon="x" wire:click="closeChangeModal" />
                        </div>
                    </div>
                    <div class="card-body display">
                        <div class="space-y-2">
                            <div>
                                <x-input label="Catequizando(a)" value="{{ $changeStudent['name'] }}" readonly />
                            </div>
                            <div>
                                <x-native-select wire:model="newAttendance" label="Novo status" required>
                                    <option value="">Selecione</option>
                                    <option value="C">C</option>
                                    <option value="F">F</option>
                                    <option value="J">J</option>
                                    <option value="R">R</option>
                                </x-native-select>
                            </div>
                            <div>
                                <x-textarea wire:model="newComment" rows="2" label="Motivo da alteração" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-button wire:click="saveChange" primary label="Salvar" />
                    </div>
                </div>
            </x-modal>
        @endif
    @endcan
</div>
