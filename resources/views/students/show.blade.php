<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizando: {{ $student->name }}</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <x-tab-link href="{{ route('students.show', $student) }}" active="{{ !$section }}" label="Resumo" />
                        <x-tab-link href="{{ route('students.show', [$student, 'detalhes']) }}" active="{{ $section === 'detalhes' }}" label="Adicionais" />
                        <x-tab-link href="{{ route('students.show', [$student, 'contatos']) }}" active="{{ $section === 'contatos' }}" label="Endereço e contatos" />
                        <x-tab-link href="{{ route('students.show', [$student, 'familiares']) }}" active="{{ $section === 'familiares' }}" label="Familiares" />
                        <x-tab-link href="{{ route('students.show', [$student, 'historico']) }}" active="{{ $section === 'historico' }}" label="Histórico" />
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <button type="button" aria-controls="mobile-menu" aria-expanded="false" @click="showtabs = !showtabs">
                    <span class="sr-only">Open menu</span>
                    Links
                    <i class="ml-2 fa fa-chevron-down"></i>
                </button>
            </div>

            <div class="sm:hidden" x-show="showtabs" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-90"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <x-tab-link href="{{ route('students.show', $student) }}" active="{{ !$section }}" label="Resumo" />
                <x-tab-link href="{{ route('students.show', [$student, 'detalhes']) }}" active="{{ $section === 'detalhes' }}" label="Adicionais" />
                <x-tab-link href="{{ route('students.show', [$student, 'contatos']) }}" active="{{ $section === 'contatos' }}" label="Endereço e contatos" />
                <x-tab-link href="{{ route('students.show', [$student, 'familiares']) }}" active="{{ $section === 'familiares' }}" label="Familiares" />
                <x-tab-link href="{{ route('students.show', [$student, 'historico']) }}" active="{{ $section === 'historico' }}" label="Histórico" />
            </div>
        </nav>
    </x-slot>

    @if (!$section)
        @livewire('student.sumary', ['student' => $student])
    @endif
    @if ($section === 'contatos')
        @livewire('student.contact', ['student' => $student])
    @endif
    @if ($section === 'familiares')
        @livewire('student.kinship', ['student' => $student])
    @endif
    @if ($section === 'historico')
        @livewire('student.history', ['student' => $student])
    @endif

    {{-- <div class="mt-4 md:grid md:grid-cols-2 gap-4">

    </div> --}}

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Contatos e endereço</li>
        <li>- Documentos (lazy)</li>
    </ul>
</x-app-layout>
