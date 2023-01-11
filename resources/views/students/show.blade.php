<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizando: {{ $student->name }}</h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações pessoais</h3>
        </div>
        <div class="card-body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div class="col-span-2">
                    <h4>Nome completo</h4>
                    <p>{{ $student->name }}</p>
                </div>
                <div>
                    <h4>Data de nascimento</h4>
                    <p>{{ $student->birth->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h4>Idade</h4>
                    <p>{{ $student->age }} anos</p>
                </div>
                @hasrole('admin')
                    <div class="col-span-4">
                        <h4>Comunidade</h4>
                        <p>{{ $student->community->name }}</p>
                    </div>
                @endhasrole
                <div>
                    <h4>Etapa atual</h4>
                    <p>{{ $student->grade->title }}</p>
                </div>
                <div class="col-span-2">
                    <h4>Catequista(s)</h4>
                    <p>
                        @foreach ($catechists as $catechist)
                            {{ $catechist->name }}
                            @if (!$loop->last)
                                e
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            footer
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Histórico de etapas</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Ano</th>
                            <th>Etapa</th>
                            <th>Aprovado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <td>{{ $group->year }}</td>
                                <td>{{ $group->grade->title }}</td>
                                <td>{{ $group->pivot->approved }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Familiares</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Parentesco</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kinships as $kinship)
                            <tr>
                                <td>{{ $kinship->name }}</td>
                                <td>{{ $kinship->pivot->title }}</td>
                                <td>{{ $kinship->pivot->is_enroller }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Contatos e endereço</li>
        <li>- Informações de contato</li>
        <li>- Documentos (lazy)</li>
        <li>- Anotações (lazy)</li>
    </ul>
</x-app-layout>
