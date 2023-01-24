<div class="md:max-w-3xl mx-auto">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Temas</h3>
        </div>
        <ul>
            @forelse ($themes as $theme)
                <li x-data="{ show: false }" class="py-2 px-4 border-b last:border-none">
                    <div class="flex space-x-4 items-center">
                        <div class="grow">
                            <a @click="show = !show" class="block cursor-pointer">
                                <span class="font-medium">{{ $theme->sequence }}.</span> {{ $theme->title }}
                            </a>
                        </div>
                    </div>
                    <div x-show="show" x-transition.opacity class="py-2 pl-4 text-sm">
                        {{ $theme->description }}
                    </div>
                </li>
            @empty
                <x-empty label="Nenhum tema cadastrado para esta etapa." />
            @endforelse
        </ul>
    </div>
</div>
