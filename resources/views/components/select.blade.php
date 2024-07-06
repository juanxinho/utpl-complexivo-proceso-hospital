<select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'appearance-none dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm']) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $key => $label)
        <option class="" value="{{ $key }}" @if(old($name, $value) == $key) selected @endif>{{ $label }}</option>
    @endforeach
</select>
