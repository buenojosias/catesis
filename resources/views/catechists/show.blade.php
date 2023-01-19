<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequista: {{ $catechist->name }}</h2>
    </x-slot>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif
    <div class="card">
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div class="col-span-2">
                    <h4>Nome completo</h4>
                    <p>{{ $catechist->name }}</p>
                </div>
                <div class="col-span-2">
                    <h4>E-mail</h4>
                    <p>{{ $catechist->email }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Data de nascimento</h4>
                    <p>{{ $catechist->profile->birth->format('d/m/Y') }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Estado civil</h4>
                    <p>{{ $catechist->profile->marital_status }}</p>
                </div>
                @hasrole('admin')
                    <div class="col-span-4">
                        <h4>Comunidade</h4>
                        <p>{{ $catechist->community->name }}</p>
                    </div>
                @endhasrole
            </div>
        </div>
    </div>
    <div class="mt-4 md:grid md:grid-cols-2 gap-4">
        <div>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $groups->where('year', date('Y'))->where('finished', false)->count() > 1? 'Grupos atuais': 'Grupo atual' }}
                    </h3>
                </div>
                <div class="card-body">
                    @foreach ($groups->where('year', date('Y'))->where('finished', false) as $group)
                        <div class="flex justify-between flex-wrap p-4 border-b last:border-none">
                            <div class="font-semibold">
                                <a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a>
                            </div>
                            <div>
                                <x-badge outline secondary label="{{ $group->weekday }}, {{ $group->time->format('H:i') }}" />
                            </div>
                            <div class="basis-full text-sm">{{ $group->students_count }} catequizandos</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
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
            </div>
        </div>
        <div>
            <div class="card">
                @livewire('catechist.contact', ['catechist' => $catechist])
            </div>
            @can('catechist_edit')
                <div class="card mt-4">
                    @livewire('catechist.edit-role', ['catechist' => $catechist])
                </div>
            @endcan
        </div>
    </div>
    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Turma atual</li>
        <li>- Histórico de turmas</li>
    </ul>
</x-app-layout>
