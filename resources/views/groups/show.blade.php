<x-app-layout>
    <x-notifications />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grupo: {{ $group->grade->title }}</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <x-tab-link href="{{ route('groups.show', $group) }}" active="{{ !$section }}"
                            label="Sobre" />
                        <x-tab-link href="{{ route('groups.show', [$group, 'catequizandos']) }}"
                            active="{{ $section === 'catequizandos' }}" label="Catequizandos" />
                        <x-tab-link href="{{ route('groups.show', [$group, 'encontros']) }}"
                            active="{{ $section === 'encontros' }}" label="Encontros" />
                        <x-tab-link href="{{ route('groups.show', [$group, 'temas']) }}"
                            active="{{ $section === 'temas' }}" label="Temas" />
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <x-button type="button" right-icon="chevron-down" class="block w-full" aria-controls="mobile-menu"
                    aria-expanded="false" @click="showtabs = !showtabs">
                    @php
                        switch ($section) {
                            case 'catequizandos':
                                echo 'Catequizandos';
                                break;
                            case 'encontros':
                                echo 'Encontros';
                                break;
                            case 'temas':
                                echo 'Temas';
                                break;
                            default:
                                echo 'Sobre';
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
                <x-tab-link href="{{ route('groups.show', $group) }}" active="{{ !$section }}" label="Sobre" />
                <x-tab-link href="{{ route('groups.show', [$group, 'catequizandos']) }}"
                    active="{{ $section === 'catequizandos' }}" label="Catequizandos" />
                <x-tab-link href="{{ route('groups.show', [$group, 'encontros']) }}"
                    active="{{ $section === 'encontros' }}" label="Encontros" />
                <x-tab-link href="{{ route('groups.show', [$group, 'temas']) }}" active="{{ $section === 'temas' }}"
                    label="Temas" />
            </div>
        </nav>
    </x-slot>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif
    @if (!$section)
        @livewire('group.about', ['group' => $group, 'weekdays' => $weekdays])
    @endif
    {{-- @if ($section === 'catequizandos')
        @livewire('group.students', ['group' => $group])
    @endif --}}
    @if ($section === 'encontros')
        @livewire('group.encounters', ['group' => $group])
    @endif
    @if ($section === 'temas')
        @livewire('group.themes', ['group' => $group])
    @endif
</x-app-layout>
