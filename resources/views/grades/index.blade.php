<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Etapas</h2>
    </x-slot>
    @livewire('grade.index')
    <h4 class="mt-4 font-bold">Colunas</h4>
    <ul>
        <li>- Nome</li>
        <li>- Quantidade de catequizandos</li>
        <li>- Quantidade de turmas *?</li>
    </ul>
</x-app-layout>
