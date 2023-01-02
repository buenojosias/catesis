<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grupos</h2>
    </x-slot>

    @livewire('group.index')
   
    <h4 class="mt-4 font-bold">Colunas</h4>
    <ul>
        <li>- Etapa</li>
        <li>- Comunidade (se admin)</li>
        <li>- Catequista(s)</li>
        <li>- Quantidade de catequizandos</li>
    </ul>
</x-app-layout>