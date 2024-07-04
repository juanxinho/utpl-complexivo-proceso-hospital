@props(['active'])

@php
$classes = ($active ?? false)
            ? 'mb-4 inline-block underline font-medium py-2 px-4 text-malachite-600 font-bold dark:text-malachite-300'
            : 'mb-4 inline-block hover:underline font-medium py-2 px-4 dark:text-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
