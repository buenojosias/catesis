@extends('layouts.printable')
@section($title = 'Ficha do catequizando')
@section('content')
    <div class="page">
        <div class="subpage">
            <div class="header">
                <div class="grow">
                    ARQUIDIOCESE DE CURITIBA<br>
                    {{ $parish->name}}<br>
                    @if($community)
                    {{ $community->name }}<br>
                    @endif
                    PASTORAL CATEQUÉTICA<br>
                    <span class="text-red">BAIRRO - CIDADE - PR</span>
                </div>
            </div>
            <h1>FICHA DE INSCRIÇÃO</h1>
            <h2>INFORMAÇÕES {{ $student->profile->gender === 'Feminino' ? 'DA CATEQUIZANDA' : 'DO CATEQUIZANDO' }}</h2>
            <div class="infos">
                <div class="col-span-2 border-t border-l">
                    <div class="label">Nome</div>
                    <div class="value">{{ $student->name }}</div>
                </div>
                <div>
                    <div class="label">Data de nascimento</div>
                    <div class="value">{{ $student->birthday->format('d/m/Y') }}</div>
                </div>
                <div>
                    <div class="label">Naturalidade</div>
                    <div class="value">{{ $student->profile->naturalness }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Endereço</div>
                    <div class="value">
                        {{ $student->address->address }}
                        {{ $student->address->complement ? ' - '.$student->address->complement : '' }}
                    </div>
                </div>
                <div>
                    <div class="label">Bairro</div>
                    <div class="value">{{ $student->address->district }}</div>
                </div>
                <div>
                    <div class="label">Cidade</div>
                    <div class="value">{{ $student->address->city }}/PR</div>
                </div>
                <div>
                    <div class="label">{{ $student->profile->gender === 'Feminino' ? 'É batizada?' : 'É batizado?' }}</div>
                    <div class="value">{{ $student->profile->has_baptism ? 'Sim' : 'Não' }}</div>
                </div>
                <div>
                    <div class="label">Data de batismo</div>
                    <div class="value">{{ $student->profile->baptism_date ? $student->profile->baptism_date->format('d/m/Y') : '---'}}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Igreja do batismo</div>
                    <div class="value">{{ $student->profile->baptism_church ?? '---'}}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Possui algum problema de saúde?</div>
                    <div class="value">{{ $student->profile->health_problem ?? '---'}}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Telefone/WhatsApp</div>
                    <div class="value">{{ $student->contact->whatsapp ?? $student->contact->phone ?? '---' }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">E-mail</div>
                    <div class="value">{{ $student->contact->email ?? '---' }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Escola onde estuda</div>
                    <div class="value">{{ $student->profile->school ?? '---' }}</div>
                </div>
            </div>
            <h2>INFORMAÇÕES DO RESPONSÁVEL</h2>
            <div class="infos">
                <div class="col-span-2 border-t border-l">
                    <div class="label">Nome</div>
                    <div class="value">{{ $enroller->name }}</div>
                </div>
                <div>
                    <div class="label">Grau de parentesco</div>
                    <div class="value">{{ $enroller->pivot->title }}</div>
                </div>
                <div>
                    <div class="label">Mora junto?</div>
                    <div class="value">{{ $enroller->pivot->lives_together ? 'Sim' : 'Não' }}</div>
                </div>
                <div>
                    <div class="label">Data de nascimento</div>
                    <div class="value">{{ $enroller->birthday->format('d/m/Y') }}</div>
                </div>
                <div>
                    <div class="label">Religião</div>
                    <div class="value">{{ $enroller->profile->religion ?? '---' }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Profissão</div>
                    <div class="value">{{ $enroller->profile->profession ?? '---' }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">Telefone/WhatsApp</div>
                    <div class="value">{{ $enroller->contact->whatsapp ?? $enroller->contact->phone ?? '---' }}</div>
                </div>
                <div class="col-span-2">
                    <div class="label">E-mail</div>
                    <div class="value">{{ $enroller->contact->email ?? '---' }}</div>
                </div>
            </div>

            <div class="mt-6 text-justify text-[10pt]">
                <p>[ ] Eu, {{ $enroller->name }}, declaro estar ciente e concordar com o Termo de Compromisso dos Pais/Responsáveis,
                    consciente dos ensinamentos religiosos que pretendo para {{ $student->profile->gender === 'Feminino' ? 'a catequizanda' : 'o catequizando' }}.</p>
                <p class="mt-2">Curitiba, {{ date('d') }} de {{ $monthLabels[intval(date('m'))] }} de {{ date('Y') }}.</p>
            </div>

            <div class="mt-16 grid grid-cols-2 gap-10 text-center text-[10pt] leading-tight">
                <div class="border-t border-black pt-1">
                    {{ $user->name }}<br>
                    {{ $user->roles[0]->label }}
                </div>
                <div class="border-t border-black pt-1">
                    {{ $enroller->name }}<br>
                    {{ $enroller->pivot->title }}
                </div>
            </div>
        </div>
    </div>
@endsection
