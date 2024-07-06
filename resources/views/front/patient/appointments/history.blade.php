<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
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
                                <li>
                                    <strong>{{ $appointment->service_date->format('d M Y, H:i') }}</strong> with Dr. {{ $appointment->medic->profile->full_name }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
