<div class="mb-4">
    @can('group_create')
        <x-button wire:click="openCreateCodeModal" label="Gerar código" primary class="mb-4" />
    @endcan
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Expiração</th>
                        <th width="1%">Inscrições</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($codes as $code)
                        <tr>
                            <td>
                                <a href="{{ route('enrollments', $code) }}">{{ $code->code }}</a>
                            </td>
                            <td>{{ $code->expires_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $code->enrollments_count }}</td>
                            <td></td>
                        </tr>
                    @empty
                        <x-empty />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal wire:model.defer="createCodeModal" max-width="md">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gerar código</h3>
            </div>
            <div class="card-body p-4">
                @if ($created_code && $created_code != null)
                    <p>Código gerado com sucesso!</p>
                    <p class="text-sm mt-2">Código</p>
                    <p class="text-xl font-semibold">{{ $created_code['code'] }}</p>
                    <p class="text-sm mt-2">Válido até</p>
                    <p>{{ Carbon\Carbon::parse($created_code['expires_at'])->format('d/m/Y H:i') }}</p>
                    <p class="text-sm mt-2">Link de acesso</p>
                    <p>catesis.com.br/inscricao</p>
                @else
                    <p>Ao clicar no botão abaixo, será gerado um código aleatório para você compartilhar para os
                        responsáveis fazerem a inscrição dos catequizandos.</p>
                    <p>Por padrão, o código irá expirar dentro de 2 horas.</p>
                @endif

            </div>
            <div class="card-footer justify-end space-x-2">
                @if ($created_code && $created_code != null)
                    <x-button label="Fechar" wire:click="closeCreateCodeModal" flat sm />
                @else
                    <x-button label="Cancelar" wire:click="closeCreateCodeModal" flat sm />
                    <x-button label="Gerar" wire:click="generateCode" primary sm />
                @endif
            </div>
        </div>
    </x-modal>

</div>
