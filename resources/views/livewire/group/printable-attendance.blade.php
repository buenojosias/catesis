<div class="header">
    <div class="">
        <p>
            {!! $group->community_id > 1 ? 'PARÓQUIA SÃO MARCOS<br>' : '' !!}
            {{ strtoupper($group->community->name) }}<br>
            PASTORAL DE ANIMAÇÃO BÍBLICO CATEQUÉTICA
        </p>
    </div>
    <div class="">
        <p>
            ETAPA: {{ strtoupper($group->grade->title) }} - {{ $group->year }}<br>
            CATEQUISTA(S):
            @foreach ($group->users as $catechist)
                {{ strtoupper($catechist->name) }}
                @if (!$loop->last)
                    E
                @endif
            @endforeach
        </p>
    </div>
</div>
<div class="title">
    CONTROLE DE FREQUÊNCIA
</div>
<div>
    <table class="table-attendance">
        <thead>
            <tr>
                <td class="column-name"></td>
                @foreach ($encounters->sortBy('date') as $encounter)
                    <th>
                        <span class="date-day">{{ $encounter->date->format('d') }}</span>
                        {{ $encounter->date->format('m') }}<br>
                    </th>
                @endforeach
                @for ($x = 1; $x <= 34 - $encounters->count(); $x++)
                    <th></th>
                @endfor

            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="column-name">
                        <div class="truncate {{ $student->status !== 'ativo' ? 'removed' : '' }}">
                            {{ $student->name }}
                        </div>
                    </td>
                    @foreach ($encounters->sortBy('date') as $encounter)
                        <td class="attendance">
                            @php
                                $cell = $encounter->students->where('id', $student->id)->first();
                            @endphp
                            @if ($cell)
                                <div class="{{ $cell->pivot->attendance === 'F' ? 'absence' : '' }} {{ $student->status !== 'ativo' ? 'removed' : '' }}">
                                    {{ $cell->pivot->attendance }}
                                </div>
                            @endif
                        </td>
                    @endforeach
                    {{-- @foreach ($student->encounters->sortBy('date') as $cell)
                        <td class="attendance">
                            <div class="{{ $cell->pivot->attendance === 'F' ? 'absence' : '' }}">
                                {{ $cell->pivot->attendance ?? '-' }}
                            </div>
                        </td>
                    @endforeach --}}
                    @for ($x = 1; $x <= 34 - $encounters->count(); $x++)
                        <td></td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
