@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-2 bg-green-800 text-sm font-bold leading-5 text-white focus:bg-green-800 outline-none focus:transition duration-150 ease-in-out w-full rounded-md'
            : 'inline-flex items-center p-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:bg-gray-200 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out w-full rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
