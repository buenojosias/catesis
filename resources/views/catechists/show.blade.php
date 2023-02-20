<x-app-layout>
    <x-dialog />
    <x-notifications />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequista: {{ $catechist->name }}</h2>
        <nav class="tabs">
            <div>
                <x-tab-link href="{{ route('catechists.show', $catechist) }}"
                    active="{{ !$section || $section === 'sobre' }}" label="Sobre" />
                <x-tab-link href="{{ route('catechists.show', [$catechist, 'perfil']) }}"
                    active="{{ $section === 'perfil' }}" label="Perfil e formações" />
                <x-tab-link href="{{ route('catechists.show', [$catechist, 'contatos']) }}"
                    active="{{ $section === 'contatos' }}" label="Contatos" />
                <x-tab-link href="{{ route('catechists.show', [$catechist, 'historico']) }}"
                    active="{{ $section === 'historico' }}" label="Histórico" />
                @if (auth()->user()->can('catechist_edit') || $catechist->id === auth()->user()->id)
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
    @if ($section === 'conta')
        @if (auth()->user()->can('catechist_edit') || $catechist->id === auth()->user()->id)
            @livewire('catechist.account', ['catechist' => $catechist])
        @else
            @php
                abort(403);
            @endphp
        @endif
    @endif

    {{-- <div class="mt-4 md:grid md:grid-cols-2 gap-4">
        <div> --}}
    {{-- <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Histórico de grupos</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover whitespace-nowrap">
                        <thead>
                            <tr>
                                <th>Ano</th>
                                <th>Etapa</th>
                                <th>Catequizandos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($groups->where('finished', true) as $group)
                                <tr>
                                    <td>{{ $group->year }}</td>
                                    <td>
                                        <a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a>
                                    </td>
                                    <td>{{ $group->students_count }}</td>
                                </tr>
                            @empty
                                <x-empty span="3" />
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> --}}
    {{-- </div> --}}
</x-app-layout>
