<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar comunidade</h2>
    </x-slot>
    {{$community}}
   
    @livewire('community.edit', ['community' => $community])
</x-app-layout>