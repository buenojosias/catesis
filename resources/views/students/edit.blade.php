<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar catequizando</h2>
        <nav class="tabs" x-data="{ showtabs: false }">
            <div>
                <div class="hidden sm:block">
                    <div class="flex items-baseline space-x-2">
                        <a href="#" class="active" aria-current="page">Principal</a>
                        <a href="#">Adicionais</a>
                        <a href="#">Endereço e contatos</a>
                        <a href="#">Familiares</a>
                        <a href="#">Anotações</a>
                    </div>
                </div>
            </div>
            <div class="flex sm:hidden">
                <button type="button" aria-controls="mobile-menu" aria-expanded="false" @click="showtabs = !showtabs">
                    <span class="sr-only">Open menu</span>
                    Links
                    <i class="ml-2 fa fa-chevron-down"></i>
                </button>
            </div>
    
            <div class="sm:hidden" x-show="showtabs"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-90"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <a href="#" class="active" aria-current="page">Principal</a>
                <a href="#">Adicionais</a>
                <a href="#">Endereço e contatos</a>
                <a href="#">Familiares</a>
                <a href="#">Anotações</a>
            </div>
        </nav>
    </x-slot>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif


    {{ $student }}

</x-app-layout>
