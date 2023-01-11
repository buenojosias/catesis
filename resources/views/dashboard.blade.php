<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="infobox-wrapper">
        <x-infobox value="100" label="Catequizandos ativos" href="#" icon="users" background="slate" />
        <x-infobox value="150" label="Grupos ativos" href="#" icon="church" />
        <x-infobox value="200" label="Catequistas" />
    </div>

    <div class="bg-white overflow-hidden shadow sm:rounded-lg">
        <div class="p-2 text-gray-900">Você está logado.</div>
    </div>
</x-app-layout>
