<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Movimentos e Pastorais</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <x-tab-link href="{{ route('pastorals.index') }}" active="{{ !$list || $list === 'past' }}"
                    label="Por pastorais" />
                <x-tab-link href="{{ route('pastorals.index', 'cat') }}" active="{{ $list === 'cat' }}"
                    label="Por catequizandos" />
            </div>
            {{-- <div class="flex sm:hidden">
                <x-button type="button" right-icon="chevron-down" class="block w-full" aria-controls="mobile-menu"
                    aria-expanded="false" @click="showtabs = !showtabs">
                    @php
                        switch ($list) {
                            case 'past':
                                echo 'Por pastorais';
                                break;
                            case 'cat':
                                echo 'Por catequizandos';
                                break;
                            default:
                                echo 'Por pastorais';
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
                <x-tab-link href="{{ route('pastorals.index') }}" active="{{ !$list || $list === 'past' }}"
                    label="Por pastorais" />
                <x-tab-link href="{{ route('pastorals.index', 'cat') }}" active="{{ $list === 'cat' }}"
                    label="Por catequizandos" />
            </div> --}}
        </nav>
    </x-slot>

    @if (!$list || $list === 'past')
        @livewire('pastoral.per-pastoral')
    @endif
    @if ($list === 'cat')
        @livewire('pastoral.per-student')
    @endif
</div>
