<div>
    <p>{{ __('Confirm your appointment') }}</p>
    <p>{{ __('Specialty') }}: {{ $this->state['specialty_id'] }}</p>
    <p>{{ __('Doctor') }}: {{ $this->state['doctor_id'] }}</p>
    <p>{{ __('Date') }}: {{ $this->state['appointment_date'] }}</p>
    <p>{{ __('Time') }}: {{ $this->state['appointment_time'] }}</p>
    <x-button wire:click="finish">{{ __('Confirm') }}</x-button>
</div>
