<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizando: {{ $student->name }}</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <a href="#" class="active" aria-current="page">Resumo</a>
                        <a href="#">Histórico</a>
                        <a href="#">Endereço e contatos</a>
                        <a href="#">Familiares</a>
                        <a href="#">Anotações</a>
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <button type="button" aria-controls="mobile-menu" aria-expanded="false" @click="showtabs = !showtabs">
                    <span class="sr-only">Open menu</span>
                    Links
                    <i class="ml-2 fa fa-chevron-down"></i>
                </button>
            </div>

            <div class="sm:hidden" x-show="showtabs"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-90"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <a href="#" class="active" aria-current="page">Principal</a>
                <a href="#">Adicionais</a>
                <a href="#">Endereço e contatos</a>
                <a href="#">Familiares</a>
                <a href="#">Anotações</a>
            </div>
        </nav>
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

    <div class="mt-4 md:grid md:grid-cols-2 gap-4">
        <div class="card mb-4">
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

        <div class="card mb-4">
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
