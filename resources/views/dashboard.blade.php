<x-app-layout>
    <div class="infobox-wrapper">
        <x-infobox value="{{ $students_count }}" label="{{ $role === 'catechist' ? 'Seus catequizandos ativos' : 'Catequizandos ativos'}}" href="{{ route('students.index') }}"
            icon="children" />
        <x-infobox value="{{ $groups_count }}" label="Grupos ativos" href="{{ route('groups.index') }}"
            icon="people-group" />
        <x-infobox value="{{ $catechists_count }}" label="Catequistas" href="{{ route('catechists.index') }}"
            icon="users" />
    </div>
    {{-- <div class="grid md:grid-cols-3 gap-4">
        <div class="md:col-span-2"> --}}
    <div class="bg-white shadow rounded">
        <div class="p-4 flex flex-col md:flex-row">
            <div class="flex-1">
                <p class="font-semibold text-gray-700">Bem vindo(a),</p>
                <h2 class="text-2xl font-bold">{{ $name }}</h2>
            </div>
            <div class="md:pb-0 flex items-center">
                <p class="font-semibold text-gray-700">
                    @if ($role === 'admin')
                        Coordenador Paroquial
                    @else
                        {{-- {{ $community->name }} --}}
                    @endif
                </p>
            </div>
        </div>
        <div class="md:grid md:grid-cols-3 bg-gray-50 border-t divide-x rounded-b">
            @if ($role === 'coordinator' || $role === 'secretary')
                <div class="text-center font-semibold">
                    <a href="{{ route('students.create') }}" class="block p-2"><i class="fas fa-plus"></i>
                        Catequizando</a>
                </div>
            @endif
            @if ($role === 'coordinator' || $role === 'admin')
                <div class="text-center font-semibold">
                    <a href="{{ route('catechists.create') }}" class="block p-2"><i class="fas fa-plus"></i>
                        Catequista</a>
                </div>
                <div class="text-center font-semibold">
                    <a href="{{ route('events.index') }}" class="block p-2"><i class="fas fa-plus"></i>
                        Evento</a>
                </div>
            @endif
        </div>
        {{-- mais cards... --}}
    </div>
    <div class="mt-4 grid md:grid-cols-2 gap-4">
        <div>
            @if($today_group)
                <div class="card mb-4">
                    <div class="card-body display px-4 sm:flex content-center gap-4">
                        <div class="">
                            <p>Um ou mais de seus grupos tem encontro hoje.</p>
                        </div>
                        <div class="pt-2 sm:pt-0 sm:w-1/2 flex content-center">
                            <x-button href="{{ route('groups.encounter', [$today_group, $today_group->encounters->first()]) }}" sm primary label="Registrar frequência" class="w-full" />
                        </div>
                    </div>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Próximos eventos</h3>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse ($events->slice(0, 3) as $event)
                            <li class="py-2 px-4 border-b">
                                <h4 class="text-sm font-medium text-gray-600 grow">
                                    {{ $event->date }}
                                    {{ $event->end_date ? ' a ' . $event->end_date->format('d/m') : '' }}
                                </h4>
                                <p class="font-medium text-gray-900">{{ $event->title }}</p>
                            </li>
                        @empty
                            <li class="py-3 px-4 text-sm">Nenhum evento programado.</li>
                        @endforelse
                    </ul>
                </div>
                @if ($events->count() > 3)
                    <div class="card-footer justify-center">
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold">Ver todos</a>
                    </div>
                @endif
            </div>
        </div>
        <div>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Aniversariantes</h3>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse ($birthdays as $birthday)
                            <li class="py-2 px-4 border-b">
                                <p class="font-medium text-gray-900">
                                    <a href="{{ route('students.show', $birthday) }}">{{ $birthday->name }}</a>
                                </p>
                                <h4 class="text-sm font-medium text-gray-600 grow">
                                    {{ $birthday->birthday->format('d/m') }} ({{ $birthday->grade->title }})
                                </h4>
                            </li>
                        @empty
                            <li class="py-3 px-4 text-sm">Nenhum aniversariante na semana atual.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        {{-- mais cards... --}}
        {{-- </div> --}}
    </div>
</x-app-layout>
