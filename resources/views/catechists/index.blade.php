<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequistas</h2>
    </x-slot>

    <x-button-link href="{{ route('catechists.create') }}">Cadastrar novo</x-button-link>
   
    @livewire('catechist.index')
</x-app-layout>