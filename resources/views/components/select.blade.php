<div>
    <select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-select']) }}>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $key => $label)
            <option value="{{ $key }}" @if(old($name, $value) == $key) selected @endif>{{ $label }}</option>
        @endforeach
    </select>
</div>
