<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Appointments') }}
        </h2>
    </x-slot>
    
    @if($appointments)
        @foreach ($appointments as $appointment)
            <h1 class="text-2xl font-bold mb-4">{{ __('Appointment Details') }}</h1>
            <div class="bg-white p-6 rounded-lg shadow">
                <p>{{ __('Date') }}: {{ $appointment->service_date }}</p>
                <p>{{ __('Schedule') }}: {{ $appointment->medicSchedule->schedule->time_range }}</p>
                <p>{{ __('Doctor') }}: {{ $appointment->medicSchedule->user->profile->first_name}} {{ $appointment->medicSchedule->user->profile->last_name }}</p>
                <p>{{ __('Specialty') }}: {{ $appointment->medicSchedule->specialty->name }}</p> 
                <p>{{ __('Status') }}: {{ $appointment->status }}</p>
            </div>
        @endforeach 
    @else
        <p>{{ __('No appointment found.') }}</p>
    @endif
    
</x-app-layout>
