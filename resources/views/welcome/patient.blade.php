<!-- Next Appointment Card -->
<h1 class="text-2xl font-bold mb-4">{{ __('Welcome') }}, {{ Auth::user()->name }}!</h1>

<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Next Appointment') }}</h5>
        @if($nextAppointment)
            <p class="mb-3 font-normal text-gray-700">{{ $nextAppointment->date->format('F j, Y, g:i a') }}</p>
            <a href="{{ route('appointments.show', $nextAppointment->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                {{ __('View Details') }}
            </a>
        @else
            <p class="mb-3 font-normal text-gray-700">{{ __('No upcoming appointments') }}</p>
        @endif
    </div>
</div>

<!-- Appointment History Card -->
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Appointment History') }}</h5>
        <p class="mb-3 font-normal text-gray-700">{{ __('View your past appointments') }}</p>
        <a href="{{ route('appointments.history') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            {{ __('View History') }}
        </a>
    </div>
</div>

<!-- Review Results Card -->
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Review Results') }}</h5>
        <p class="mb-3 font-normal text-gray-700">{{ __('Check your medical test results') }}</p>
        {{--<a href="{{ route('results.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            {{ __('Review Results') }}
        </a>--}}
    </div>
</div>

<!-- Review Prescriptions Card -->
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Review Prescriptions') }}</h5>
        <p class="mb-3 font-normal text-gray-700">{{ __('View your prescribed medications') }}</p>
        {{--<a href="{{ route('prescriptions.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            {{ __('Review Prescriptions') }}
        </a>--}}
    </div>
</div>

<!-- Review My Treatments Card -->
<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Review My Treatments') }}</h5>
        <p class="mb-3 font-normal text-gray-700">{{ __('View your ongoing treatments') }}</p>
        {{--<a href="{{ route('treatments.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            {{ __('Review My Treatments') }}
        </a>--}}
    </div>
</div>
