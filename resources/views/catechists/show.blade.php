<x-app-layout>
    <x-dialog />
    <x-notifications />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequista: {{ $catechist->name }}</h2>
        <nav class="tabs">
            <div>
                <x-tab-link href="{{ route('catechists.show', $catechist) }}"
                    active="{{ !$section || $section === 'sobre' }}" label="Sobre" />
                <x-tab-link href="{{ route('catechists.show', [$catechist, 'contatos']) }}"
                    active="{{ $section === 'contatos' }}" label="Contatos" />
                <x-tab-link href="{{ route('catechists.show', [$catechist, 'historico']) }}"
                    active="{{ $section === 'historico' }}" label="Histórico e formações" />
                @if (
                    (auth()->user()->can('catechist_edit') && !$catechist->hasRole('admin')) ||
                        $catechist->id === auth()->user()->id ||
                        auth()->user()->hasRole('super-admin'))
                    <x-tab-link href="{{ route('catechists.show', [$catechist, 'conta']) }}"
                        active="{{ $section === 'conta' }}" label="Configurações da conta" />
                @endif
            </div>
        </nav>
    </x-slot>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif
    @if (!$section || $section === 'sobre')
        @livewire('catechist.about', ['catechist' => $catechist])
    @endif
    @if ($section === 'contatos')
        @livewire('catechist.contact', ['catechist' => $catechist])
    @endif
    @if ($section === 'historico')
        @livewire('catechist.history', ['catechist' => $catechist])
    @endif
    @if ($section === 'conta')
        @if (
            (auth()->user()->can('catechist_edit') && !$catechist->hasRole('admin')) ||
                $catechist->id === auth()->user()->id ||
                auth()->user()->hasRole('super-admin'))
            @livewire('catechist.account', ['catechist' => $catechist])
        @else
            @php
                abort(403);
            @endphp
        @endif
    @endif
</x-app-layout>
