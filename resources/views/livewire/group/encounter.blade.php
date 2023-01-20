<x-app-layout>
    <x-notifications />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Encontro</h2>
    </x-slot>
    <div class="md:grid md:grid-cols-5 space-y-3 md:space-y-0 gap-4">
        <div class="col-span-2">
            <div class="card mb-4">
                <div class="card-body display">
                    <div>
                        <h4>Grupo</h4>
                        <p>
                            <a href="{{ route('groups.show', $group) }}">
                                {{ $group->grade->title }} <i class="ml-2 fa fa-arrow-up-right-from-square"></i>
                            </a>
                        </p>
                    </div>
                    <div class="sm:grid sm:grid-cols-2 space-y-3 sm:space-y-0 gap-4 my-4">
                        <div>
                            <h4>Data do encontro</h4>
                            <p>{{ $encounter->date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h4>Método</h4>
                            <p>{{ $encounter->method }}</p>
                        </div>
                    </div>
                    <div>
                        <h4>Tema abordado</h4>
                        <p>{{ $encounter->theme->title }}</p>
                    </div>
                    @hasrole('admin')
                        <div class="mt-4">
                            <h4>Comunidade</h4>
                            <p>{{ $group->community->name }}</p>
                        </div>
                    @endhasrole
                </div>
            </div>
        </div>

        <div class="col-span-3">
            @if ($encounter->date->format('Y-m-d') > date('Y-m-d'))
                <div class="card">
                    <div class="card-body display">
                        <p>Você poderá registrar e consultar a chamada a partir da data do encontro.</p>
                    </div>
                </div>
            @else
                <div>
                    @livewire('encounter.attendance', ['encounter' => $encounter, 'group' => $group])
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
