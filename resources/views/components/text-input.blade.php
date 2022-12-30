@props(['name','label','disabled' => false])

<label for="{{ $name }}" class="block mb-1 font-medium text-sm text-gray-700">{{ $label }}</label>
<input id="{{ $name }}" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
