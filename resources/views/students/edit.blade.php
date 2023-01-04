<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar catequizando</h2>
    </x-slot>
    @if (session('success'))
        <x-success message="{{ session('success') }}" />
    @endif


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
        <div class="flex p-1 sm:hidden">
            <button type="button" aria-controls="mobile-menu" aria-expanded="false" @click="showtabs = !showtabs">
                <span class="sr-only">Open menu</span>
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
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


    {{ $student }}

</x-app-layout>
