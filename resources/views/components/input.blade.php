@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm']) !!}>
