<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequistas</h2>
    </x-slot>
    @can('user_create')
        <x-button blue label="Cadastrar novo" class="mb-4" href="{{ route('catechists.create') }}" />
    @endcan
    @livewire('catechist.index')
</x-app-layout>
