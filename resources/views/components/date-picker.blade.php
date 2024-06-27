<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let picker = new Pikaday({
            field: document.getElementById('{{ $id }}'),
            format: 'YYYY-MM-DD',
            maxDate: moment().toDate(),
            defaultDate: '{{ $defaultdate }}'
        });
    });
</script>

@props(['id', 'name', 'defaultdate' => '', 'value' => ''])

<div
    x-data="{ value: '{{ $defaultdate }}' }"
    x-init="
        new Pikaday({
            field: $refs.input,
            format: 'YYYY-MM-DD',
            maxDate: moment().toDate(),
            defaultDate: '{{ $defaultdate }}',
            setDefaultDate: true,
            onSelect: function(date) {
                value = this.getMoment().format('YYYY-MM-DD');
                $dispatch('input', value);
                @this.set('{{ $attributes->wire('model')->value() }}', value);
            }
        })
    "
>
    <input x-ref="input" type="date" name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm']) }} x-model="value" />
</div>
