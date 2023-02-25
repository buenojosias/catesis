<x-app-layout>
    <x-notifications />
    <x-dialog />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Festa das inscrições</h2>
    </x-slot>
    <div>
        @if (!$code)
            @livewire('enrollment.codes')
        @endif
        @if ($code)
            @livewire('enrollment.show', ['code' => $code])
        @endif
    </div>
</x-app-layout>
