<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizandos</h2>
    </x-slot>
    @can('student_create')
        <x-button primary href="{{ route('students.create') }}" label="Cadastrar novo" class="mb-2" />
    @endcan
    @livewire('student.index')
</x-app-layout>
