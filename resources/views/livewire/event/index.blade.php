<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Agenda de eventos</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <x-tab-link href="{{ route('events.index') }}" active="{{ !$section || $section === 'calendario' }}"
                            label="Calendário" />
                        <x-tab-link href="{{ route('events.index', 'lista') }}" active="{{ $section === 'lista' }}"
                            label="Lista" />
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <x-button type="button" right-icon="chevron-down" class="block w-full" aria-controls="mobile-menu"
                    aria-expanded="false" @click="showtabs = !showtabs">
                    @php
                        switch ($section) {
                            case 'calendario':
                                echo 'Calendário';
                                break;
                            case 'lista':
                                echo 'Lista';
                                break;
                            default:
                                echo 'Calendário';
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
                <x-tab-link href="{{ route('events.index') }}" active="{{ !$section || $section === 'calendario' }}"
                    label="Calendário" />
                <x-tab-link href="{{ route('events.index', 'lista') }}" active="{{ $section === 'lista' }}"
                    label="Lista" />
            </div>
        </nav>
    </x-slot>

    @if (!$section || $section === 'calendario')
        @livewire('event.calendar')
    @endif
    @if ($section === 'cat')
        @livewire('event.lista')
    @endif
</div>
