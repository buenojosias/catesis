<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Encontros</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <x-tab-link href="{{ route('encounters.index') }}" active="{{ $section === 'proximos' }}"
                            label="Próximos" />
                        <x-tab-link href="{{ route('encounters.index', 'realizados') }}"
                            active="{{ $section === 'realizados' }}" label="Realizados" />
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <x-button type="button" right-icon="chevron-down" class="block w-full" aria-controls="mobile-menu"
                    aria-expanded="false" @click="showtabs = !showtabs">
                    @php
                        switch ($section) {
                            case 'realizados':
                                echo 'Realizados';
                                break;
                            default:
                                echo 'Próximos';
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
                <x-tab-link href="{{ route('encounters.index') }}" active="{{ $section === 'proximos' }}" label="Próximos" />
                <x-tab-link href="{{ route('encounters.index', 'realizados') }}"
                    active="{{ $section === 'realizados' }}" label="Realizados" />
            </div>
        </nav>
    </x-slot>
    @livewire('encounter.index', ['period' => $section])
</x-app-layout>
