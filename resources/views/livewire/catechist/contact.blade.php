<div>
    <div class="card-header">
        <h3 class="card-title">Contatos</h3>
        @can('student_edit')
            <div class="card-tools">
                <x-button wire:click="openContactModal()" sm flat label="Editar" />
            </div>
        @endcan
    </div>
    <div class="card-body">
        <ul>
            <li class="py-2 px-4 border-b">
                <h4 class="text-sm font-medium text-gray-600">Telefone</h4>
                <p class="font-medium text-gray-900">{{ $contact->phone ?? 'Não informado' }}</p>
            </li>
            <li class="py-2 px-4 border-b">
                <h4 class="text-sm font-medium text-gray-600">WhatsApp</h4>
                <p class="font-medium text-gray-900">{{ $contact->whatsapp ?? 'Não informado' }}</p>
            </li>
            <li class="py-2 px-4 border-b">
                <h4 class="text-sm font-medium text-gray-600">E-mail</h4>
                <p class="font-medium text-gray-900">{{ $contact->email ?? 'Não informado' }}</p>
            </li>
            <li class="py-2 px-4 font-medium">
                REDES SOCIAIS
            </li>
            <li class="py-2 px-4 border-b">
                <h4 class="text-sm font-medium text-gray-600">Facebook</h4>
                <p class="font-medium text-gray-900">{{ $contact->facebook ?? 'Não informado' }}</p>
            </li>
            <li class="py-2 px-4">
                <h4 class="text-sm font-medium text-gray-600">Instagram</h4>
                <p class="font-medium text-gray-900">{{ $contact->instagram ?? 'Não informado' }}</p>
            </li>
        </ul>
    </div>
</div>
