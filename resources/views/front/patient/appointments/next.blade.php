<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Appointments') }}
        </h1>
    </x-slot>
    
    @if($appointments)
        @foreach ($appointments as $appointment)
        
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-md font-bold text-gray-900 text-gray-500 dark:text-gray-400">{{ __('Appointment Details') }}</h2>
                <p>{{ __('Date') }}: {{ ucfirst(\Carbon\Carbon::parse($appointment->service_date)->translatedFormat('l, j \d\e F \d\e Y')) }} </p>
                <p>{{ __('Time') }}: {{ $appointment->medicSchedule->schedule->time_range }}</p>
                <p>{{ __('Doctor') }}: {{ $appointment->medicSchedule->user->profile->first_name}} {{ $appointment->medicSchedule->user->profile->last_name }}</p>
                <p>{{ __('Specialty') }}: {{ $appointment->medicSchedule->specialty->name }}</p> 
                <p>{{ __('Status') }}: {{ $appointment->status }}</p>
            </div>
            <br/>
        @endforeach 
    @else
        <p>{{ __('No appointment found.') }}</p>
    @endif
    
</x-app-layout>
