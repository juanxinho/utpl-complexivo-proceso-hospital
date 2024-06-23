<div>
    <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(['class' => 'form-input']) }} />
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#{{ $id }}", {
                dateFormat: "{{ $dateFormat }}",
                maxDate: "{{ $maxDate }}",
                defaultDate: "{{ $value }}",
            });
        });
    </script>
@endpush
