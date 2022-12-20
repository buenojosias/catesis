@props(['active','icon'])

@php
$classes = ($active ?? false)
            ? 'text-base text-gray-900 font-normal rounded-lg bg-slate-200 hover:bg-gray-100 group transition duration-75 flex items-center p-2'
            : 'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2';
            // : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="fa fa-{{$icon}} w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
    <span class="ml-2">{{ $slot }}</span>
</a>


{{-- <a href="#"
    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
    <i class="fa fa-home w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
    <span class="ml-4">Comunidades</span>
</a> --}}

