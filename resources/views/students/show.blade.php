<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catequizando: {{$student->name}}</h2>
    </x-slot>

    {{$student}}<br>

    <div class="card">
        <div class="heading">
            <h3>Informações pessoais</h3>
        </div>
        <div class="body display">
            <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                <div class="col-span-2">
                    <h4>Nome completo</h4>
                    <p>{{$student->name}}</p>
                </div>
                <div>
                    <h4>Data de nascimento</h4>
                    <p>{{$student->birth->format('d/m/Y')}}</p>
                </div>
                <div>
                    <h4>Idade</h4>
                    <p>{{$student->age}} anos</p>
                </div>
                @hasrole('admin')
                <div class="col-span-4">
                    <h4>Comunidade</h4>
                    <p>{{$student->community->name}}</p>
                </div>
                @endhasrole
                <div>
                    <h4>Etapa atual</h4>
                    <p>{{$student->grade->title}}</p>
                </div>
            </div>
        </div>
        <div class="footer">
            footer
        </div>
    </div>

    <h4 class="mt-4 font-bold">Recursos</h4>
    <ul>
        <li>- Informações básicas</li>
        <li>- Contatos e endereço</li>
        <li>- Comunidade/etapa/catequista</li>
        <li>- Histórico de etapas</li>
        <li>- Informações de contato</li>
        <li>- Familiares (talvez lazy ou fazer em outra view)</li>
        <li>- Documentos (lazy)</li>
        <li>- Anotações (lazy)</li>
    </ul>
</x-app-layout>