<div x-data="{ 'form': false }" class="mb-2">
    <div x-show="!form" @click="form = true" class="card flex p-4 cursor-pointer">
        <div class="flex-1 font-semibold">
            Contatos
        </div>
        @if ($contact)
            <div>
                <x-icon name="check-circle" class="w-6 h-6 text-green-800" />
            </div>
        @endif
    </div>
    <div x-show="form" @close.window="form = false">
        @if (!$contact)
            <form wire:submit.prevent="submit" class="form-card">
                <div class="heading">
                    <h3>Contatos</h3>
                    <p>Informe os contatos do catequizando. Os contatos dos familiares e responsáveis serão solicitados nas próximas etapas.</p>
                    <x-errors class="shadow" />
                </div>
                <div class="body">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-2">
                            <x-inputs.phone wire:model.defer="phone" label="Telefone"
                                mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-inputs.phone wire:model.defer="whatsapp" label="WhatsApp"
                                mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="email" label="E-mail" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="facebook" label="Facebook" placeholder="https://facebook.com/usuario" />
                        </div>
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="instagram" label="Instagram" placeholder="Apenas nome do usuário" />
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <x-button type="submit" sm primary label="Continuar" />
                </div>
            </form>
        @else
            <div class="card mb-4">
                <div class="card-header cursor-pointer" @click="form = false">
                    <h3 class="card-title">Contatos</h3>
                </div>
                <div class="card-body display">
                    <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                        <div>
                            <h4>Telefone</h4>
                            <p>{{ $contact->phone }}</p>
                        </div>
                        <div>
                            <h4>WhatsApp</h4>
                            <p>{{ $contact->whatsapp }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>E-mail</h4>
                            <p>{{ $contact->email }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>Facebook</h4>
                            <p>{{ $contact->facebook }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>Instagram</h4>
                            <p>{{ $contact->instagram }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
