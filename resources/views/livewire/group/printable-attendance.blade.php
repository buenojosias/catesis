<div>
    <div class="p-1 sm:p-2 overflow-x-auto bg-white shadow">
        <div class="w-full flex flex-col sm:flex-row sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4 p-2 divide-y sm:divide-y-0 border border-black font-semibold uppercase">
            <div class="sm:w-1/2 text-center sm:text-left">
                <p>
                    {!! $group->community_id > 1 ? 'PARÓQUIA SÃO MARCOS<br>' : '' !!}
                    {{ strtoupper($group->community->name) }}<br>
                    PASTORAL DA CATEQUESE
                </p>
            </div>
            <div class="sm:w-1/2 text-center sm:text-left">
                <p>
                    {{ strtoupper($group->grade->title) }} - {{ $group->year }}<br>
                    CATEQUISTA(S):<br>
                    @foreach ($group->users as $catechist)
                        {{ strtoupper($catechist->name) }}
                        @if (!$loop->last)
                            E
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
        <div class="py-0.5 border-l border-r border-black bg-gray-100 text-center font-semibold">
            CONTROLE DE FREQUÊNCIA
        </div>
        <div class="table-responsive whitespace-nowrap border border-black text-sm">
            {{--  --}}
            <table class="table-attendance text-sm w-full">
                <thead>
                    <tr>
                        <td class="font-semibold"></td>
                        @foreach ($encounters->sortBy('date') as $encounter)
                            <td class="w-10 px-1 border-l border-black font-semibold">{{ $encounter->date->format('d/m') }}
                            </td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="border-t border-black">
                            <td class="py-0.5 px-1 {{ $student->status !== 'ativo' ? 'text-gray-400' : '' }}">{{ $student->name }}</td>
                            @foreach ($student->encounters->sortBy('date') as $cell)
                                <td
                                    class="border-l border-black text-center font-semibold {{ $cell->pivot->attendance === 'F' ? 'text-red-700' : '' }}">
                                    {{ $cell->pivot->attendance ?? '-' }}
                                </td>
                            @endforeach
                            @for ($x = 1; $x <= $encounters->count() - $student->encounters->count(); $x++)
                                <td class="border-l border-black"></td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
