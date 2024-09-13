<x-app-layout>
    <h2 class="text-2xl font-bold mb-4 dark:text-malachite-300">{{ __('Welcome') }}, {{ $user->profile->first_name }} {{ $user->profile->last_name }}!</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <!-- Next Appointment Card -->
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Next Appointment') }}</h5>
                @if($nextAppointment)
                    <p class="mb-3 font-normal text-gray-700">{{ ucfirst(\Carbon\Carbon::parse($nextAppointment->service_date)->translatedFormat('l, j \d\e F \d\e Y')) }} / {{ $nextAppointment->medicSchedule->schedule->time_range }} / {{ $nextAppointment->medicSchedule->specialty->name }}</p>
                    <a href="{{ route('medic.appointments.index') }}" >
                        {{ __('View Details') }}
                    </a>
                @else
                    <p class="mb-3 font-normal text-gray-700">{{ __('No upcoming appointments') }}</p>
                @endif
            </div>
        </div>

        <!-- Patient Records Card -->
        {{--<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Patient Records') }}</h5>
                <p class="mb-3 font-normal text-gray-700">{{ __('Check Patient Records') }}</p>
                <x-button-link href="" >
                    {{ __('View Patient Records') }}
                </x-button-link>
            </div>
        </div>--}}

    </div>
</x-app-layout>
