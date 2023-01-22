<x-app-layout>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif
    <x-notifications />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizando: {{ $student->name }}</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <x-tab-link href="{{ route('students.show', $student) }}" active="{{ !$section }}"
                            label="Resumo" />
                        <x-tab-link href="{{ route('students.show', [$student, 'comentarios']) }}"
                            active="{{ $section === 'comentarios' }}" label="Comentários" />
                        <x-tab-link href="{{ route('students.show', [$student, 'contatos']) }}"
                            active="{{ $section === 'contatos' }}" label="Contatos e familiares" />
                        <x-tab-link href="{{ route('students.show', [$student, 'historico']) }}"
                            active="{{ $section === 'historico' }}" label="Histórico" />
                        <x-tab-link href="{{ route('students.show', [$student, 'outros']) }}"
                            active="{{ $section === 'outros' }}" label="Outros" />
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <x-button type="button" right-icon="chevron-down" class="block w-full" aria-controls="mobile-menu"
                    aria-expanded="false" @click="showtabs = !showtabs">
                    @php
                        switch ($section) {
                            case 'comentarios': echo 'Comentários'; break;
                            case 'contatos': echo 'Contatos e familiares'; break;
                            case 'familiares': echo 'Familiares'; break;
                            case 'historico': echo 'Histórico'; break;
                            case 'outros': echo 'Outros'; break;
                            default: echo 'Resumo';
                        }
                    @endphp
                    <span class="sr-only">Open menu</span>
                </x-button>
            </div>
            <div class="sm:hidden" x-show="showtabs" @click.outside="showtabs=false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-90"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <x-tab-link href="{{ route('students.show', $student) }}" active="{{ !$section }}"
                    label="Resumo" />
                <x-tab-link href="{{ route('students.show', [$student, 'comentarios']) }}"
                    active="{{ $section === 'comentarios' }}" label="Comentários" />
                <x-tab-link href="{{ route('students.show', [$student, 'contatos']) }}"
                    active="{{ $section === 'contatos' }}" label="Contatos e familiares" />
                <x-tab-link href="{{ route('students.show', [$student, 'historico']) }}"
                    active="{{ $section === 'historico' }}" label="Histórico" />
                <x-tab-link href="{{ route('students.show', [$student, 'outros']) }}"
                    active="{{ $section === 'outros' }}" label="Outros" />
            </div>
        </nav>
    </x-slot>
    @if (!$section)
        @livewire('student.sumary', ['student' => $student])
    @endif
    @if ($section === 'contatos')
        @livewire('student.contact', ['student' => $student])
    @endif
    @if ($section === 'comentarios')
        @livewire('student.comments', ['student' => $student])
    @endif
    @if ($section === 'familiares')
        @livewire('student.kinship', ['student' => $student])
    @endif
    @if ($section === 'historico')
        @livewire('student.history', ['student' => $student])
    @endif
    @if ($section === 'outros')
        @livewire('student.others', ['student' => $student])
    @endif
</x-app-layout>
