<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizandos</h2>
    </x-slot>
    @can('student_create')
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-4">Cadastrar novo</a>
    @endcan
    @livewire('student.index')
</x-app-layout>
