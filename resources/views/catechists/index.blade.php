<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequistas</h2>
    </x-slot>

    <a href="{{ route('catechists.create') }}" class="btn btn-primary mb-4">Cadastrar novo</a>
   
    @livewire('catechist.index')
</x-app-layout>