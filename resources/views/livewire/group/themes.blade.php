<div class="md:max-w-3xl mx-auto">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Temas</h3>
        </div>
    </div>
    <ul class="focusable">
        @forelse ($themes as $theme)
            <li x-data="{ expand: false }">
                <div x-show="!expand" @click="expand=true" class="focusable-item">
                    <span class="text-sm text-gray-600 font-medium">{{ $theme->sequence }}.</span> {{ $theme->title }}
                </div>
                <div x-show="expand" @click.outside="expand=false" class="focusable-focus">
                    <div class="flex border-b">
                        <div class="flex-1">
                            <h4><span class="text-sm text-gray-600 font-medium">{{ $theme->sequence }}.</span>
                                {{ $theme->title }}</h4>
                        </div>
                    </div>
                    <div class="py-2">
                        <p class="text-justify">{{ $theme->description }}</p>
                    </div>
                </div>
            </li>
        @empty
            <x-empty label="Nenhum tema cadastrado para esta etapa." />
        @endforelse
    </ul>


    {{-- <div class="card mb-4">
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
    </div> --}}
</div>
