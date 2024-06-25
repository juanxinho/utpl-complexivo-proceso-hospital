<select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm']) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $key => $label)
        <option value="{{ $key }}" @if(old($name, $value) == $key) selected @endif>{{ $label }}</option>
    @endforeach
</select>
