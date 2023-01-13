<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comunidades: {{ $community->name }}</h2>
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
                            @foreach ($catechists as $catechist)
                                <tr>
                                    <td>
                                        <a href="{{ route('catechists.show', $catechist) }}">{{ $catechist->name }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
                        @foreach ($groups as $group)
                            <tr>
                                <td>
                                    <a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a>
                                </td>
                                <td>{{ $group->students_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $community }}

    <h4 class="mt-4 font-bold">Informações da comunidade</h4>
    <ul>
        <li>- Endereço</li>
        <li>- Coordenador(es)</li>
        <li>- Catequizandos</li>
        <li>- Catequistas</li>
        <li>- Turmas atuais</li>
    </ul>
</x-app-layout>
