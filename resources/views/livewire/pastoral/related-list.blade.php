<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Movimentos e pastorais</h3>
        </div>
        <div class="card-body">
            @if ($display_list)
            <ul>
                @forelse ($pastorals as $pastoral)
                    <li class="flex py-2 px-4 border-b">
                        <div class="grow">
                            <h4 class="font-medium text-gray-900">{{ $pastoral->name }}</h4>
                            <p class="text-sm font-medium text-gray-600">{{ $pastoral->community->name }}</p>
                        </div>
                        <div class="flex items-center">
                            <x-button xs flat icon="trash" />
                        </div>
                    </li>
                @empty
                    <x-empty label="Nenhum movimento ou pastoral vinculado." />
                @endforelse
            </ul>
            @else
                <div class="py-3 px-4 text-center font-semibold text-sm">
                    <a wire:click="loadList" class="cursor-pointer">Carregar</a>
                </div>
            @endif
        </div>
    </div>

</div>
