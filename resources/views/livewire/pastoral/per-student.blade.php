<div class="sm:grid sm:grid-cols-3 sm:space-x-6">
    <div class="col-span-2 mb-2">
        <h4 class="mb-4 text-lg font-semibold">Exibindo catequizandos
            {{ $communities ? 'da comunidade ' . $community_name : '' }} que {!! $has_pastoral ? '' : '<span class="underline">não</span>' !!} participam de
            movimentos ou pastorais.</h4>

        <ul class="focusable">
            @foreach ($students as $key => $student)
                <li x-data="{ expand: false }">
                    <div x-show="!expand" @click="expand=true" class="focusable-item">
                        {{ $student->name }}</div>
                    <div x-show="expand" @click.outside="expand=false" class="focusable-focus">
                        <div class="flex border-b">
                            <div class="flex-1">
                                <h4>{{ $student->name }}</h4>
                            </div>
                            @if ($student->community_id === auth()->user()->community_id || auth()->user()->hasRole('admin'))
                                <div class="px-2">
                                    <x-button href="{{ route('students.show', $student) }}" sm flat icon="eye" />
                                </div>
                            @endif

                        </div>
                        <ul class="text-sm">
                            @foreach ($student->pastorals as $pastoral)
                                <li class="sm:flex mx-4 py-2 border-b last:border-none">
                                    <div class="font-semibold text-gray-900">{{ $pastoral->name }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
            <div class="pt-4">
                {{ $students->links() }}
            </div>
        </ul>

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
