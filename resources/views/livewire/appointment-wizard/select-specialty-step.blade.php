<div>
    <select id="specialty" name="specialty" label="{{ __('Select Specialty') }}" wire:model="id_specialty">
        @foreach($specialties as $specialty)
            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
        @endforeach
    </select>
    <x-button wire:click="nextStep">{{ __('Next') }}</x-button>
</div>
