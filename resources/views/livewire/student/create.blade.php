<div>
    <x-notifications />
    @livewire('student.create.profile')
    @if ($student)
        @livewire('student.create.address', ['student' => $student])
        @livewire('student.create.contact', ['student' => $student])
        @livewire('student.create.kinship', ['student' => $student])
        @if ($kinship)
            @livewire('student.create.matriculation', ['student' => $student, 'kinship' => $kinship])
        @else
            <div class="flex card mb-2 p-4 opacity-60 cursor-not-allowed">
                <div class="flex-1">
                    <span class="mr-2 font-semibold">Grupo/Matrícula</span>
                    <span class="text-sm">Vincule a um familiar responsável primeiro.</span>
                </div>
                <div>
                    <x-icon name="ban" class="w-6 h-6 text-gray-800" />
                </div>
            </div>
        @endif
    @endif
</div>
