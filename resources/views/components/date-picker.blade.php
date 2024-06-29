@props(['id', 'name', 'defaultdate' => '', 'value' => ''])

<div x-data="{ value: '{{ $defaultdate }}' }">
    <input x-ref="input" type="date" name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm']) }} x-model="value" />
</div>
