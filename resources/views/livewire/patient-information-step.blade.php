<div>
    <x-input label="{{ __('First Name') }}" wire:model="first_name" />
    <x-input label="{{ __('Last Name') }}" wire:model="last_name" />
    <x-input label="{{ __('Email') }}" wire:model="email" />
    <x-input label="{{ __('Phone') }}" wire:model="phone" />
    <x-button wire:click="nextStep">{{ __('Next') }}</x-button>
</div>
