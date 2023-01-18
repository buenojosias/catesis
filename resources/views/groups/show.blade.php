<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grupo: {{ $group->grade->title }}</h2>
    </x-slot>
    @if ($group->finished)
        <div class="mb-4 py-3 px-4 bg-sky-800 rounded shadow text-white font-medium">
            Este grupo finalizou em {{ $group->end_date->format('d/m/Y') }}
        </div>
    @endif
    @livewire('group.show', ['group' => $group])
    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Encontros/temas</li>
    </ul>
</x-app-layout>
