<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequistas</h2>
    </x-slot>
    @if(auth()->user()->can('user_create') || auth()->user()->hasRole('super-admin'))
        <x-button href="{{ route('catechists.create') }}" label="Cadastrar novo" primary class="mb-3 w-full sm:w-auto" />
    @endif
    @livewire('catechist.index')
</x-app-layout>
