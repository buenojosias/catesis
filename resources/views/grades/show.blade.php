<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Etapas: {{ $grade->title }}</h2>
    </x-slot>

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Nome / descrição</li>
        <li>- Quantidade de catequizandos</li>
        <li>- Quantidade de catequizandos por comunidade (se admin)</li>
        <li>- Temas</li>
        <li>- Turmas *?</li>
    </ul>
</x-app-layout>