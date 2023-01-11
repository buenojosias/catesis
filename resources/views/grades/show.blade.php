<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Etapas: {{ $grade->title }}</h2>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <h3>Descrição</h3>
        </div>
        <div class="card-body py-3 px-4">
            <p>{{ $grade->description ?? 'Nenhuma descrição disponível.' }}</p>
        </div>
    </div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        @hasrole('admin')
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Catequizandos por comunidade</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($communities as $community)
                                <tr>
                                    <td>{{ $community->name }}</td>
                                    <td class="text-right">{{ $community->active_students_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endhasrole
        <div class="card mb-4">
            <div class="card-header">
                <h3>Temas</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <tbody>
                        @foreach ($themes as $theme)
                            <tr>
                                <td>{{ $theme->sequence }}. {{ $theme->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Nome / descrição</li>
        <li>- Quantidade de catequizandos</li>
    </ul>
</x-app-layout>
