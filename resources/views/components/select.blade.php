<select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-green-600 focus:ring-malachite-600 dark:focus:border-green-300 dark:focus:ring-malachite-300 rounded-md shadow-sm']) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $key => $label)
        <option value="{{ $key }}" @if(old($name, $value) == $key) selected @endif>{{ $label }}</option>
    @endforeach
</select>
