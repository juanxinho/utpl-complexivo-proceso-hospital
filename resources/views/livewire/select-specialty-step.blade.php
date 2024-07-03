<div>
    <x-select label="{{ __('Select Specialty') }}" wire:model="specialty_id">
        @foreach($specialties as $specialty)
            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
        @endforeach
    </x-select>
    <x-button wire:click="nextStep">{{ __('Next') }}</x-button>
</div>
