<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações pessoais</h3>
        </div>
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div class="col-span-2">
                    <h4>Nome completo</h4>
                    <p>{{ $student->name }}</p>
                </div>
                <div>
                    <h4>Data de nascimento</h4>
                    <p>{{ $student->birth->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h4>Idade</h4>
                    <p>{{ $student->age }} anos</p>
                </div>
                @hasrole('admin')
                    <div class="col-span-4">
                        <h4>Comunidade</h4>
                        <p>{{ $student->community->name }}</p>
                    </div>
                @endhasrole
                <div>
                    <h4>Etapa atual</h4>
                    <p>{{ $student->grade->title ?? 'Nenhuma' }}</p>
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
                <a wire:click="showComments" class="block p-2 border-t cursor-pointer">Comentários</a>
            </div>
            <div class="text-center font-semibold">
                <a class="block p-2 border-t cursor-pointer">Editar</a>
            </div>
            <div class="text-center font-semibold">
                <a class="block p-2 border-t cursor-pointer" wire:click="openRematriculationModal()">Fazer rematrícula</a>
            </div>
        </div>
    </div>
    @if ($rematriculationModal)
        @can('student_edit')
            <x-modal wire:model.defer="rematriculationModal">
                @livewire('student.rematriculation', ['student' => $student])
            </x-modal>
        @endcan
    @endif
    @if ($comments)
        @livewire('student.comments', ['student' => $student])
    @endif
</div>
