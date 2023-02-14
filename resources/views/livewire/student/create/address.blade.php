<div x-data="{ 'form': false }" class="mb-2">
    <div x-show="!form" @click="form = true" class="card flex p-4 cursor-pointer">
        <div class="flex-1 font-semibold">
            Endereço
        </div>
        @if ($saved_address)
            <div>
                <x-icon name="check-circle" class="w-6 h-6 text-green-800" />
            </div>
        @endif
    </div>
    <div x-show="form" @close.window="form = false">
        @if (!$saved_address)
            <form wire:submit.prevent="submit" class="form-card">
                <div class="heading">
                    <h3>Endereço</h3>
                    <p>Informe aqui o endereço do catequizando.</p>
                    <x-errors class="shadow" />
                </div>
                <div class="body">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="address" label="Endreço *" required />
                        </div>
                        <div class="sm:col-span-4">
                            <x-input wire:model.defer="complement" label="Complemento" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input wire:model.defer="district" label="Bairro *" required />
                        </div>
                        <div class="sm:col-span-2">
                            <x-input wire:model.defer="city" label="Cidade*" suffix="/PR" required />
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
                    <h3 class="card-title">Endereço</h3>
                </div>
                <div class="card-body display">
                    <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                        <div class="col-span-3">
                            <h4>Endereço</h4>
                            <p>{{ $saved_address->address }}</p>
                        </div>
                        <div>
                            <h4>Complemento</h4>
                            <p>{{ $saved_address->complement }}</p>
                        </div>
                        <div class="col-span-2">
                            <h4>Bairro</h4>
                            <p>{{ $saved_address->district }}</p>
                        </div>
                        <div>
                            <h4>Cidade</h4>
                            <p>{{ $saved_address->city }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
