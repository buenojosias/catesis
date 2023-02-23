<div class="md:grid md:grid-cols-2 gap-4">
    <div class="mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Endereço</h3>
            </div>
            <div class="card-body display">
                <div>
                    <h4>Endereço</h4>
                    <p class="mb-2">{{ $address->address ?? 'Não informado' }}</p>
                </div>
                @if (@$address->complement)
                    <div>
                        <h4>Complemento</h4>
                        <p class="mb-2">{{ $address->complement }}</p>
                    </div>
                @endif
                <div>
                    <h4>Bairro</h4>
                    <p class="mb-2">{{ $address->district ?? 'Não informado' }}</p>
                </div>
                <div>
                    <h4>Cidade</h4>
                    <p class="mb-2">{{ $address->city ?? 'Não informada' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contatos</h3>
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
</div>
