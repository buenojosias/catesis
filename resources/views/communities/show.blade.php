<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comunidades: {{ $community->name }}</h2>
    </x-slot>
   
    <h4 class="mt-4 font-bold">Informações da comunidade</h4>
    <ul>
        <li>- Endereço</li>
        <li>- Coordenador(es)</li>
        <li>- Catequizandos</li>
        <li>- Catequistas</li>
        <li>- Turmas atuais</li>
    </ul>
</x-app-layout>