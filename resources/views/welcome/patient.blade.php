<x-app-layout>
<h2 class="text-2xl font-bold mb-4 dark:text-malachite-300">{{ __('Welcome') }}, {{ $user->profile->first_name }} {{ $user->profile->last_name }}!</h2>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Next Appointment Card -->
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Schedule an appointment') }}</h5>
            <x-button-link href="{{ route('front.patient.appointments.create') }}" >
                {{ __('Schedule an appointment') }}
            </x-button-link>
        </div>
    </div>

    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Next Appointments') }}</h5>
            @if($nextAppointment)
                <p class="mb-3 font-normal text-gray-700">{{ $nextAppointment->service_date}}</p>
                <a href="{{ route('front.patient.appointments.show', $nextAppointment->id_appointment) }}" >
                    {{ __('View Details') }}
                </a>
            @else
                <p class="mb-3 font-normal text-gray-700">{{ __('No upcoming appointments') }}</p>
            @endif
        </div>
    </div>

    <!-- Appointment History Card -->
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Appointment History') }}</h5>
            <p class="mb-3 font-normal text-gray-700">{{ __('View your past appointments') }}</p>
            <x-button-link href="{{ route('front.patient.appointments.history') }}" >
                {{ __('View History') }}
            </x-button-link>
        </div>
    </div>

    <!-- Review Results Card -->
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Review Results') }}</h5>
            <p class="mb-3 font-normal text-gray-700">{{ __('Check your medical test results') }}</p>
            {{--<a href="{{ route('results.index') }}" >
                {{ __('Review Results') }}
            </a>--}}
        </div>
    </div>

    <!-- Review Prescriptions Card -->
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Review Prescriptions') }}</h5>
            <p class="mb-3 font-normal text-gray-700">{{ __('View your prescribed medications') }}</p>
            {{--<a href="{{ route('prescriptions.index') }}" >
                {{ __('Review Prescriptions') }}
            </a>--}}
        </div>
    </div>

    <!-- Review My Treatments Card -->
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Review My Treatments') }}</h5>
            <p class="mb-3 font-normal text-gray-700">{{ __('View your ongoing treatments') }}</p>
            {{--<a href="{{ route('treatments.index') }}" >
                {{ __('Review My Treatments') }}
            </a>--}}
        </div>
    </div>
</div>
</x-app-layout>
