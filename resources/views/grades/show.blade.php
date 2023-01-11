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

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Nome / descrição</li>
        <li>- Quantidade de catequizandos</li>
        <li>- Quantidade de catequizandos por comunidade (se admin)</li>
        <li>- Temas</li>
        <li>- Turmas *?</li>
    </ul>
</x-app-layout>
