<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Appointment') }}
        </h2>
    </x-slot>

    @if($appointment)
        <h1 class="text-2xl font-bold mb-4">{{ __('Appointment Details') }}</h1>
        <div class="bg-white p-6 rounded-lg shadow">
            <p>{{ __('Date') }}: {{ $appointment->service_date }}</p>
            <p>{{ __('Doctor') }}: {{ $appointment->medicSchedule->user->profile->first_name}} {{ $appointment->medicSchedule->user->profile->last_name }}</p>
            <p>{{ __('Specialty') }}: {{ $appointment->medicSchedule->specialty->name }}</p>
            <p>{{ __('Patient') }}: {{ $appointment->user->profile->first_name }}  {{ $appointment->user->profile->last_name }}</p>
            <p>{{ __('Status') }}: {{ $appointment->status }}</p>
        </div>
    @else
        <p>{{ __('No appointment found.') }}</p>
    @endif
</x-app-layout>

