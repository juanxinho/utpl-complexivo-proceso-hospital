<div>
    <x-input label="{{ __('Select Date') }}" type="date" wire:model="appointment_date" />
    <x-input label="{{ __('Select Time') }}" type="time" wire:model="appointment_time" />
    <x-button wire:click="nextStep">{{ __('Next') }}</x-button>
</div>
