@props([
    'value',
    'label',
    'icon' => null,
    'href' => null,
])

{{-- <div class="infobox bg-{{ $background ? $background.'-600' : 'white' }} {{ $background ? 'text-white' : '' }}"> --}}
<div class="infobox bg-sky-600 text-white">
    <div class="inner">
        <h3>{{ $value }}</h3>
        <p>{{ $label }}</p>
    </div>
    @if ($icon)
        <div class="icon">
            <i class="fas fa-{{ $icon }}"></i>
        </div>
    @endif
    @if ($href)
        <a href="{{ $href }}" class="footer bg-gray-900/25">
            Lista <i class="fas fa-arrow-circle-right text-xs opacity-60"></i>
        </a>
    @endif
</div>
