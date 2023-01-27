<div>
    @if (auth()->user()->hasRole('admin') || ($group->community_id === auth()->user()->community_id && auth()->user()->can('group_edit')))
        <x-button wire:click="openFormModal('create')" label="Cadastrar encontro" primary class="mb-3 w-full sm:w-auto" />
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Encontros</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Método</th>
                        <th>Tema</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($encounters as $encounter)
                        <tr>
                            <td>
                                <a href="{{ route('groups.encounter', [$group, $encounter]) }}">{{ $encounter->date->format('d/m/Y') }}</a>
                            </td>
                            <td>{{ $encounter->method }}</td>
                            <td>{{ $encounter->theme->title ?? '' }}</td>
                            @if ($group->community_id === auth()->user()->community_id ||
                                    auth()->user()->hasRole('admin'))
                                <td class="text-right">
                                    <x-button href="{{ route('groups.encounter', [$group, $encounter]) }}" sm flat
                                        icon="eye" />
                                    @can('group_edit')
                                        <x-button wire:click="openFormModal('edit', {{ $encounter }})" sm flat
                                            icon="pencil" />
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @empty
                        <x-empty label="Nenhum encontro programado." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @can('group_edit')
        @if ($showFormModal)
            <x-modal wire:model.defer="showFormModal" max-width="md">
                <form wire:submit.prevent="submitEncounter">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $method === 'create' ? 'Adicionar encontro' : 'Editar encontro' }}
                            </h3>
                        </div>
                        <div class="card-body display">
                            <x-errors class="mb-4 shadow" />
                            <div class="grid grid-cols-2 space-y-3 space-y-0 gap-4">
                                <div>
                                    <x-datetime-picker wire:model.defer="form.date" label="Data"
                                        placeholder="Data do encontro" without-tips without-timezone without-time />
                                </div>
                                <x-native-select wire:model.defer="form.method" label="Modalidade">
                                    @if ($method === 'create')
                                        <option value="">Selecione</option>
                                    @endif
                                    <option value="presencial">Presencial</option>
                                    <option value="familiar">Familiar</option>
                                </x-native-select>
                                <div class="col-span-2">
                                    <x-native-select wire:model.defer="form.theme_id" label="Tema">
                                        @if ($method === 'create')
                                            <option value="">Selecione</option>
                                        @endif
                                        @foreach ($themes as $theme)
                                            <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                                        @endforeach
                                    </x-native-select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex justify-between gap-x-4">
                                <x-button x-on:click="close" sm flat label="Cancelar" />
                                <x-button type="submit" sm primary label="Salvar" />
                            </div>
                        </div>
                    </div>
                </form>
            </x-modal>
        @endif
    @endcan
</div>
