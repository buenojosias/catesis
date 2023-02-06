@extends('layouts.printable')
@section($title = 'Ficha do grupo')
@section('content')
    <div class="page">
        <div class="subpage">
            <div class="header">
                <div class="grow">
                    ARQUIDIOCESE DE CURITIBA<br>
                    {{ $group->parish->name }}<br>
                    @if ($group->community)
                        {{ $group->community->name }}<br>
                    @endif
                    PASTORAL CATEQUÉTICA<br>
                    {{ $group->community->detail->district ?? $group->parish->detail->district }} - {{ $group->community->detail->city ?? $group->parish->detail->city }} - PR
                </div>
            </div>
            <h1>FICHA DO GRUPO</h1>
            <h2>INFORMAÇÕES</h2>
            <div class="infos">
                <div class="border-l border-t">
                    <div class="label">Ano</div>
                    <div class="value">{{ $group->year }}</div>
                </div>
                <div class="col-span-3">
                    <div class="label">Etapa</div>
                    <div class="value">{{ $group->grade->title }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Dia e horário dos encontros</div>
                    <div class="value">{{ $weekdays[$group->weekday] }} | {{ $group->time->format('H:i') }}</div>
                </div>
                <div>
                    <div class="label">Data de início</div>
                    <div class="value">{{ $group->start_date->format('d/m/Y') }}</div>
                </div>
                <div>
                    <div class="label">Data de encerramento</div>
                    <div class="value">{{ $group->end_date ? $group->end_date->format('d/m/Y') : '' }}</div>
                </div>
                <div class="col-span-4">
                    <div class="label">Catequista(s)</div>
                    <div class="value">
                        @forelse ($catechists as $catechist)
                            {{ $catechist->name }}
                            @if (!$loop->last)
                                e
                            @endif
                        @empty
                            Nenhum catequista adicionado
                        @endforelse
                    </div>
                </div>
            </div>
            <h2>CATEQUIZANDOS</h2>
            <table class="mt-2 text-[12pt] w-full">
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr class="border-b border-gray-600">
                            <td class="w-[1cm] text-right">{{ $key+1 }}.</td>
                            <td>
                                {{ $student->name }}
                            </td>
                            <td class="w-[2cm] text-right">{{ \Carbon\Carbon::parse($student->birthday)->age }} anos</td>
                            <td class="w-[3cm]">{{ $student->pivot->status !== 'Ativo' ? $student->pivot->status : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
