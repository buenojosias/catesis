@props(['active','label'])

@php
$classes = ($active ?? false)
    ? 'active'
    : '';
@endphp

<a {{ $attributes->merge(['class' => $classes])}}>
    {{ $label }}
</a>
