<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequistas / {{$user->name}}</h2>
    </x-slot>

    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif
   
    {{$user}}<br>

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Turma atual</li>
        <li>- Histórico de turmas</li>
    </ul>
</x-app-layout>