<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar catequizando</h2>
    </x-slot>
    @livewire('student.create')
    {{-- @livewire('student.create.finished', ['student' => 'Teste']) --}}
</x-app-layout>
