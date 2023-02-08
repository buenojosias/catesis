@props(['active','label'])

@php
$classes = ($active ?? false)
    ? 'active whitespace-nowrap'
    : 'whitespace-nowrap';
@endphp

<a {{ $attributes->merge(['class' => $classes])}}>
    {{ $label }}
</a>
