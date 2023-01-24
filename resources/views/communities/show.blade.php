<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comunidade: {{ $community->name }}</h2>
    </x-slot>
    <div class="card">
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div class="col-span-2">
                    <h4>Nome</h4>
                    <p>{{ $community->name }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Endereço</h4>
                    <p>{{ $community->address }}</p>
                </div>
                <div class="col-span-4">
                    <h4>Coordenador(es)</h4>
                    <p>
                        @foreach ($coordinators as $coordinator)
                            {{ $coordinator->name }}
                            @if (!$loop->last)
                                e
                            @endif
                        @endforeach
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="mt-4 md:grid md:grid-cols-2 gap-4">
        <div>
            <div class="card mb-4">
                <div class="card-body table-responsive">
                    <table class="table table-hover whitespace-nowrap">
                        <tbody>
                            <tr>
                                <td>Catequistas</td>
                                <td class="text-right">{{ $catechists->count() }}</td>
                            </tr>
                            <tr>
                                <td>Catequizandos ativos</td>
                                <td class="text-right">{{ $students }}</td>
                            </tr>
                            <tr>
                                <td>Grupos ativos</td>
                                <td class="text-right">{{ $groups->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Catequistas</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover whitespace-nowrap">
                        <tbody>
                            @forelse ($catechists as $catechist)
                                <tr>
                                    <td>
                                        <a href="{{ route('catechists.show', $catechist) }}">{{ $catechist->name }}</a>
                                    </td>
                                </tr>
                            @empty
                                <x-empty span="1" />
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Grupos</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover whitespace-nowrap">
                        <thead>
                            <th>Nome</th>
                            <th>Catequizandos</th>
                        </thead>
                        <tbody>
                            @forelse ($groups as $group)
                                <tr>
                                    <td>
                                        <a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a>
                                    </td>
                                    <td>{{ $group->active_students_count }}</td>
                                </tr>
                            @empty
                                <x-empty span="2" />
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
