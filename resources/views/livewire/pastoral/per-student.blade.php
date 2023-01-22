<div class="sm:grid sm:grid-cols-3 sm:space-x-6">
    <div class="col-span-2 mb-2">
        <h4 class="mb-4 text-lg font-semibold">Exibindo catequizandos {{ $communities ? 'da comunidade '.$community_name : '' }} que {!! $has_pastoral ? '' : '<span class="underline">não</span>' !!} participam de
            movimentos ou pastorais.</h4>
        @foreach ($students as $student)
            <div x-data="{ expand: false }" class="card mb-2">
                <div class="card-header">
                    <h3 @click="expand = !expand" class="card-title block w-full cursor-pointer">
                        {{ $student->name }}
                    </h3>
                </div>
                <div x-show="expand" class="card-body">
                    {{-- <div class="py-2 px-4 bg-gray-100 font-semibold">
                        MOVIMENTOS E PASTORAIS
                    </div> --}}
                    <table class="table">
                        <tbody>
                            @foreach ($student->pastorals as $pastoral)
                                <tr>
                                    <td>{{ $pastoral->name }}</td>
                                    <td class="text-right">{{ $pastoral->community->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
        <div class="card-paginate">
            {{ $students->links() }}
        </div>
    </div>
    <div>
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Filtro</h3>
            </div>
            <div class="body table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td wire:click="selectFilter(1)" class="cursor-pointer">Participam de pastoral</td>
                        </tr>
                        <tr>
                            <td wire:click="selectFilter(0)" class="cursor-pointer">Não participam de pastoral</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if ($communities)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comunidades</h3>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($communities as $community)
                                <tr>
                                    <td wire:click="selectCommunity({{ $community->id }})" class="cursor-pointer">
                                        {{ $community->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
