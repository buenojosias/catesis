@extends('layouts.printable')
@section($title = 'Ficha de tranferência')
@section('content')
    <div class="page">
        <div class="subpage pt-[1cm]">
            <div class="header">
                <div class="grow">
                    ARQUIDIOCESE DE CURITIBA<br>
                    {{ $transfer->parish->name }}<br>
                    @if ($transfer->community)
                        {{ $transfer->community->name }}<br>
                    @endif
                    PASTORAL CATEQUÉTICA<br>
                    {{ $transfer->community->detail->district ?? $transfer->parish->detail->district }} - {{ $transfer->community->detail->city ?? $transfer->parish->detail->city }} - PR
                </div>
            </div>
            <h1 class="mt-10">TRANSFERÊNCIA</h1>
            <p class="mt-8 text-justify leading-7 indent-[1.5cm] text-[12pt]">
                Declaramos para os devidos fins de transferência de catequese que <span class="font-bold uppercase">{{ $student->name }}</span> frequentou a
                catequese na
                {{ $transfer->community->name ?? $transfer->parish->name }}
                nas epatas citadas abaixo.
            </p>
            <table class="my-6 w-full border border-black text-[11pt]">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th class="text-left">Etapa</th>
                        <th class="text-left">Catequista(s)</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr class="border-t border-gray-800">
                            <td class="text-center">{{ $group->year }}</td>
                            <td>{{ $group->grade->title }}</td>
                            <td>
                                @forelse ($group->users as $catechist)
                                    {{ $catechist->name }}
                                    @if (!$loop->last)
                                        e
                                    @endif
                                @empty
                                    ---
                                @endforelse
                            </td>
                            <td class="text-center">{{ $group->pivot->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-right">Curitiba, {{ $transfer->created_at->format('d') }} de {{ $monthLabels[intval($transfer->created_at->format('m'))] }} de {{ $transfer->created_at->format('Y') }}.</p>
            <div class="mt-16 grid grid-cols-2 gap-10 text-center text-[11pt] leading-tight">
                <div class="border-t border-black pt-1">
                    {{ $transfer->user->name }}<br>
                    {{ $transfer->user->roles[0]->label }}
                </div>
                <div class="border-t border-black pt-1">
                    {{ $transfer->kinship->name }}<br>
                    Responsável (solicitante)
                </div>
            </div>

        </div>
    </div>
@endsection
