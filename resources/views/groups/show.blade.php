<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grupos: {{$group->grade->title}}</h2>
    </x-slot>

    {{$group}}

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Etapa</li>
        <li>- Comunidade (se admin)</li>
        <li>- Dia/horário</li>
        <li>- Catequista(s)</li>
        <li>- Catequizandos</li>
        <li>- Encontros/temas</li>
        <li>- Início/término</li>
        <li>- Status (em andamento/concluído)</li>
    </ul>

</x-app-layout>