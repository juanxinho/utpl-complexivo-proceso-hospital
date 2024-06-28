@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-2 bg-malachite-600 dark:bg-malachite-300 text-sm font-bold leading-5 text-white dark:text-gray-800 focus:bg-malachite-600 outline-none focus:transition duration-150 ease-in-out w-full rounded-md'
            : 'inline-flex items-center p-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-white hover:text-gray-700 dark:hover:text-gray-700 hover:bg-gray-200 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out w-full rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
