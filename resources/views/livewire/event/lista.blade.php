<div>
    <x-notifications />
    <x-dialog />
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">Próximos eventos</h3>
        </div> --}}
        <div class="card-body">
            <div class="sm:grid sm:grid-cols-2 md:grid-cols-5">
                <div class="sm:order-last md:col-span-2 p-4">
                    <!-- INÍCIO DO CALENDÁRIO -->
                    <div class="mb-3 flex">
                        <div>
                            <x-button wire:click="goToPreviusMonth" sm flat icon="chevron-left" />
                        </div>
                        <div class="grow text-center font-semibold text-gray-800">
                            {{ $monthLabels[$currentMonth] }}/{{ $currentYear }}</div>
                        <div>
                            <x-button wire:click="goToNextMonth" sm flat icon="chevron-right" />
                        </div>
                    </div>
                    <div class="flex py-0.5">
                        @foreach ($dayLabels as $weekday)
                            <div class="basis-1/7 px-2 py-1 text-center text-xs">{{ $weekday }}</div>
                        @endforeach
                    </div>
                    <div class="flex flex-wrap divide-y">
                        @for ($i = 0; $i < $firstWeekdayOfMonth; $i++)
                            <div class="basis-1/7 border-t"></div>
                        @endfor
                        @for ($i = 1; $i <= $daysInMonth; $i++)
                            @php
                                $day_events = $events->where('day', $i);
                            @endphp
                            <div class="basis-1/7 h-12 flex items-center justify-center border-t">
                                <div wire:click="selectDay({{ $day_events->count() > 0 ? $i : null }})"
                                    class="
                                        w-8 h-8 flex items-center justify-center rounded-full text-sm
                                        {{ date($currentYear . '-' . substr("00{$currentMonth}", -2) . '-' . substr("00{$i}", -2)) == date('Y-m-d') && $day_events->count() == 0 ? 'text-sky-700 font-bold' : '' }}
                                        {{ $day_events->count() > 0 ? 'bg-sky-600 text-white font-semibold cursor-pointer' : 'cursor-default' }}
                                    ">
                                    {{ $i }}</div>
                            </div>
                        @endfor
                        @for ($i = 1; $i <= $remainder; $i++)
                            <div class="basis-1/7 "></div>
                        @endfor
                    </div>
                    <!-- FIM DO CALENDÁRIO -->
                    <x-button wire:click="openFormModal('create')" label="Adicionar evento"
                        class="w-full mt-6 font-semibold" md primary />
                </div>
                <div class="md:col-span-3 px-4 md:pr-6">
                    @if ($currentDay)
                        <p class="mt-2 pb-2 border-b text-sm font-semibold text-gray-600">
                            Exibindo eventos do dia
                            {{ $currentDay . '/' . $currentMonth . '/' . $currentYear }}
                            <span wire:click="selectDay({{ null }})" class="text-sm text-sky-600 cursor-pointer">[limpar
                                filtro]</span>
                        </p>
                    @endif
                    <ul>
                        @forelse ($currentDay != null ? $events->where('day', $currentDay) : $events as $event)
                            <li class="flex py-4 border-b last:border-b-0 hover:bg-gray-50">
                                <div wire:click="openShowModal({{ $event }})" class="grow cursor-pointer">
                                    <p class="font-semibold text-gray-900">{{ $event->title }}</p>
                                    <p class="text-gray-700 text-sm font-semibold">
                                        <i class="fa fa-calendar-alt text-xs text-gray-500 mr-0.5"></i>
                                        {{ strtolower($event->starts_at->format('d/m h:i')) }}
                                        {{ $event->ends_at ? 'a ' . strtolower($event->ends_at->format('d/m h:i')) : '' }}
                                    </p>
                                </div>
                                @if (
                                    $event->user_id === auth()->user()->id ||
                                        auth()->user()->hasRole('admin'))
                                    <div class="flex items-center">
                                        <x-dropdown class="px-4">
                                            <x-dropdown.item wire:click="openFormModal('edit', {{ $event }})"
                                                icon="pencil-alt" label="Editar" />
                                            <x-dropdown.item wire:click="removeEvent({{ $event }})" icon="trash"
                                                label="Remover" />
                                        </x-dropdown>
                                    </div>
                                @endif
                            </li>
                        @empty
                            <x-empty label="Nenhum evento programado para o mês selecionado." />
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @livewire('event.show-modal')
    {{-- @can('group_edit') --}}
    @if ($showFormModal)
        <x-modal wire:model.defer="showFormModal" max-width="md">
            <form wire:submit.prevent="submitEvent">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $method === 'create' ? 'Adicionar evento' : 'Editar evento' }}
                        </h3>
                    </div>
                    <div class="card-body display">
                        <x-errors class="mb-4 shadow" />
                        <div class="grid grid-cols-2 space-y-3 space-y-0 gap-4">
                            <div class="col-span-2">
                                <x-input wire:model.defer="form.title" label="Título do evento" />
                            </div>
                            <div>
                                <x-datetime-picker wire:model.defer="form.starts_at" label="Início"
                                    placeholder="Data e hora" without-timezone time-format="24" :min="now()" />
                            </div>
                            <div>
                                <x-datetime-picker wire:model.defer="form.ends_at" label="Término"
                                    placeholder="Data e hora" corner-hint="Opcional" without-timezone time-format="24"
                                    :min="now()" />
                            </div>
                            <div class="col-span-2">
                                <x-textarea wire:model.defer="form.description" label="Detalhes do evento" />
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
    {{-- @endcan --}}
</div>
