<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Familiar: {{ $kinship->name }}</h2>
    </x-slot>
    @livewire('kinship.sumary', ['kinship' => $kinship])
    <div class="md:grid md:grid-cols-2 space-y-3 md:space-y-0 gap-4">
        <div>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Catequizandos relacionados</h3>
                </div>
                <div class="card-body">
                    @foreach ($kinship->students as $student)
                        <div class="flex justify-between flex-wrap p-4 border-b last:border-none">
                            <div class="font-semibold">
                                <a href="{{ route('students.show', $student) }}">{{ $student->name }}</a>
                            </div>
                            <div>
                                @if ($student->status === 'ativo')
                                    <x-badge outline positive label="{{ $student->status }}" />
                                @else
                                    <x-badge outline warning label="{{ $student->status }}" />
                                @endif
                            </div>
                            <div class="basis-full text-sm mt-1">{{ $student->grade->title ?? 'Nenhuma etapa' }}</div>
                            <div class="basis-full text-sm">{{ $student->community->name }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pastorais</h3>
                </div>
            </div>
        </div>
        <div>
            <div class="card">
                @livewire('kinship.contact', ['kinship' => $kinship])
            </div>
        </div>
    </div>
</x-app-layout>