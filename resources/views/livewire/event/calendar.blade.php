<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ $monthLabels[$currentMonth] }}/{{ $currentYear }}
            </h3>
            <div class="card-tools">
                <x-button wire:click="goToPreviusMonth" xs icon="arrow-left" class="mr-0.5" />
                <x-button wire:click="goToNextMonth" xs icon="arrow-right" />
            </div>
        </div>
        <div class="card-body">
            <div class="flex divide-x">
                @foreach ($dayLabels as $weekday)
                    <div class="basis-1/7 px-2 py-1 text-center text-sm font-semibold">{{ $weekday }}</div>
                @endforeach
            </div>
            <div class="flex flex-wrap divide-x divide-y">
                @for ($i = 0; $i < $firstWeekdayOfMonth; $i++)
                    <div class="basis-1/7 bg-gray-100"></div>
                @endfor
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    @php
                        $day_events = $events->where('day', $i);
                    @endphp
                    <div class="basis-1/7 h-14 sm:h-24 border-t">
                        <div
                            class="w-full h-full {{ $day_events->count() > 0 ? 'rounded bg-sky-600 text-white font-semibold' : '' }} text-sm">
                            <div
                                class="h-full sm:h-auto py-1 px-2 rounded text-right cursor-pointer {{ $day_events->count() > 0 ? 'hover:bg-sky-700' : 'hover:bg-slate-200' }}">
                                {{ $i }}</div>
                            @if ($day_events->count() > 0)
                                <div class="hidden sm:inline-block px-0.5">
                                    @foreach ($day_events as $event)
                                        <div
                                            class="max-h-5 w-full mb-0.5 py-0.5 px-1 overflow-hidden bg-sky-800 hover:bg-sky-900 rounded text-xs font-normal cursor-pointer">
                                            <span>{{ $event->title }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endfor
                @for ($i = 1; $i <= $remainder; $i++)
                    <div class="basis-1/7 bg-gray-100"></div>
                @endfor
            </div>
        </div>
    </div>
</div>
