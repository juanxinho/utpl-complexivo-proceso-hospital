<div>
    <select label="{{ __('Select Doctor') }}" wire:model="doctor_id">
        @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}">{{ $doctor->profile->first_name }} {{ $doctor->profile->last_name }}</option>
        @endforeach
    </select>
    <x-button wire:click="nextStep">{{ __('Next') }}</x-button>
</div>
