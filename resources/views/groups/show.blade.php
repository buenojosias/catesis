<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grupo: {{ $group->grade->title }}</h2>
    </x-slot>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif
    @if ($group->finished)
        <div class="mb-4 py-3 px-4 bg-sky-800 rounded shadow text-white font-medium">
            Este grupo finalizou em {{ $group->end_date->format('d/m/Y') }}
        </div>
    @endif
    @livewire('group.show', ['group' => $group])
</x-app-layout>
