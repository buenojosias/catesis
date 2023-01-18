<div x-data="{ 'form': false }" class="mb-2">
    <div x-show="!form" @click="form = true" class="card flex p-4 cursor-pointer">
        <div class="flex-1 font-semibold">
            Grupo/Matrícula
        </div>
        @if ($matriculation)
            <div>
                <x-icon name="check-circle" class="w-6 h-6 text-green-800" />
            </div>
        @endif
    </div>
    <div x-show="form" @close.window="form = false">
        @if (!$matriculation)
            <form wire:submit.prevent="submit" class="form-card">
                <div class="heading">
                    <h3>Grupo/Matrícula</h3>
                    <p>Selecione um grupo para incluir o catequizando. Estão disponíveis apenas grupos em andamento ou a
                        se iniciar.</p>
                    <x-errors class="shadow" />
                </div>
                <div class="body">
                    <div class="grid sm:grid-cols-4 gap-4">
                        <div class="col-span-4">
                            <x-native-select wire:model.defer="group" label="Grupo *" required>
                                <option value="">Selecione</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->grade->title }} -
                                        {{ $group->year }}
                                    </option>
                                @endforeach
                            </x-native-select>
                        </div>
                        <div class="col-span-4">
                            <x-textarea wire:model.defer="comment" label="Comentário"
                                placeholder="Se preferir, você pode escrever uma observação sobre o(a) catequizando(a)." />
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <x-button href="{{ route('students.show', $student) }}" label="Pular" />
                    <x-button type="submit" primary label="Concluir" />
                </div>
            </form>
        @else
            <div class="card mb-4">
                <div class="card-header cursor-pointer" @click="form = false">
                    <h3 class="card-title">Grupo/Matrícula</h3>
                </div>
                <div class="card-body display">
                    <div class="md:grid md:grid-cols-4 space-y-3 md:space-y-0 gap-4">
                        <div>
                            <h4>ID da Matrícula</h4>
                            <p>{{ $matriculation->id }}</p>
                        </div>
                        <div>
                            <h4>Ano</h4>
                            <p>{{ $matriculation->year }}</p>
                        </div>
                        <div>
                            <h4>Data</h4>
                            <p>{{ Carbon\Carbon::parse($matriculation->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h4>Grupo</h4>
                            <p>{{ $group->grade->title }}</p>
                        </div>
                        <div>
                            <h4>Incínio</h4>
                            <p>{{ Carbon\Carbon::parse($group->start_date)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
