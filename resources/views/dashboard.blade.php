<x-app-layout>
    <div class="infobox-wrapper">
        <x-infobox value="{{$students_count}}" label="Catequizandos ativos" href="{{route('students.index')}}" icon="children" />
        <x-infobox value="{{$groups_count}}" label="Grupos ativos" href="{{route('groups.index')}}" icon="people-group" />
        <x-infobox value="{{$catechists_count}}" label="Catequistas" href="{{route('catechists.index')}}" icon="users" />
    </div>
    <div class="grid md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
            <div class="mb-4 bg-white shadow rounded">
                <div class="flex flex-col md:flex-row">
                    <div class="p-4 flex-1">
                        <p class="font-semibold text-gray-700">Bem vindo(a),</p>
                        <h2 class="text-3xl font-bold">{{$name}}</h2>
                        <p class="font-semibold text-gray-700">
                            @hasrole('admin')
                                Coordenador Paroquial
                            @else
                                {{$community->name}}
                            @endhasrole
                        </p>
                    </div>
                    <div class="px-4 pb-4 md:pb-0 flex items-center">
                        <x-button label="Ação" class="w-full" />
                    </div>
                </div>
                <div class="md:grid md:grid-cols-3 bg-gray-50 divide-x rounded-b">
                    <div class="text-center font-semibold">
                        <a href="#" class="block p-2 border-t">Item 1</a>
                    </div>
                    @hasanyrole(['coordinator','secretary'])
                    <div class="text-center font-semibold">
                        <a href="{{route('students.create')}}" class="block p-2 border-t"><i class="fas fa-plus"></i> Catequizando</a>
                    </div>
                    @endhasanyrole
                    @hasanyrole(['coordinator','admin'])
                    <div class="text-center font-semibold">
                        <a href="{{route('catechists.create')}}" class="block p-2 border-t"><i class="fas fa-plus"></i> Catequista</a>
                    </div>
                    @endhasanyrole
                </div>
            </div>
            {{-- mais cards... --}}
        </div>
        <div>
            <div class="card mb-4">
                <div class="card-header">
                    Próximos eventos
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Aniversariantes
                </div>
            </div>
            {{-- mais cards... --}}
        </div>

    </div>



</x-app-layout>
