<div>
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Histórico de etapas</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Etapa</th>
                        <th>Matrícula</th>
                        <th>Aprovado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->year }}</td>
                            <td>{{ $group->grade->title }}</td>
                            <td>
                                {{ $group->pivot->matriculation_id ?? '' }}
                                @if ($group->community_id !== $student->community_id)
                                    ({{ $group->community->name }})
                                @endif
                            </td>
                            <td>{{ $group->pivot->status ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @can('student_edit')
        <x-button wire:click="openRematriculationModal()" primary label="Fazer rematrícula" />
    @endcan

    {{-- @if ($rematriculationModal) --}}
    @can('student_edit')
        <x-modal wire:model.defer="rematriculationModal">
            @livewire('student.rematriculation', ['student' => $student])
        </x-modal>
    @endcan
    {{-- @endif --}}

</div>
