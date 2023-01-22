<div class="sm:grid sm:grid-cols-3 sm:space-x-6">
    <div class="col-span-2 mb-2">
        <h2 class="mb-4 border-b border-gray-300 text-2xl font-semibold text-slate-900">{{ $community_name }}</h2>
        @foreach ($pastorals as $pastoral)
            <div x-data="{ expand: false }" class="card mb-2">
                <div class="card-header">
                    <h3 @click="expand = !expand" class="card-title block w-full cursor-pointer">
                        {{ $pastoral->name }}
                    </h3>
                    @if (
                        $pastoral->user_id === auth()->user()->id ||
                            auth()->user()->hasRole('admin'))
                        <div class="card-tools">
                            <x-button flat xs icon="pencil" />
                        </div>
                    @endif
                </div>
                <div x-show="expand" class="card-body">
                    @if ($pastoral->coordinator)
                        <div class="py-2 px-4">
                            Coordenador(a): {{ $pastoral->coordinator }}
                        </div>
                    @endif
                    @if ($pastoral->encounters)
                        <div class="py-2 px-4">
                            Encontros: {{ $pastoral->encounters }}
                        </div>
                    @endif
                    @if ($pastoral->students->count() > 0)
                        <div class="py-2 px-4 bg-gray-100 font-semibold">
                            CATEQUIZANDOS PARTICIPANTES
                        </div>
                        <table class="table">
                            <tbody>
                                @foreach ($pastoral->students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td class="text-right">{{ $student->community->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if ($pastoral->kinships->count() > 0)
                        <div class="py-2 px-4 bg-gray-100 font-semibold">
                            FAMILIARES PARTICIPANTES
                        </div>
                        <table class="table">
                            <tbody>
                                @foreach ($pastoral->kinships as $kinship)
                                    <tr>
                                        <td>{{ $kinship->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div>
        <x-button primary label="ADICIONAR MOVIMENTO/PASTORAL" class="mb-4 block w-full" />
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
    </div>
</div>
