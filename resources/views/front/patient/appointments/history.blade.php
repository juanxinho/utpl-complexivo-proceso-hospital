<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Previous Appointments') }}</h3>
                    @if($appointments->isEmpty())
                        <p>{{ __('No appointment found.') }}</p>
                    @else
                        <ul>
                            @foreach($appointments as $appointment)
                                <br/>
                                <li>
                                    <strong>{{ ucfirst(\Carbon\Carbon::parse($appointment->service_date)->translatedFormat('l, j \d\e F \d\e Y')) }} / {{ $appointment->medicSchedule->schedule->time_range }}</strong> <br/>
                                    {{ $appointment->medicSchedule->specialty->name }} with Dr. {{ $appointment->medicSchedule->user->profile->first_name}} {{ $appointment->medicSchedule->user->profile->last_name }}<br/>
                                    {{ $appointment->status }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
