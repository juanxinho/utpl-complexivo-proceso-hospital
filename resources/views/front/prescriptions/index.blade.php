<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Prescriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Previous Prescriptions') }}</h3>
                    @if($prescriptions->isEmpty())
                        <p>{{ __('No prescriptions found.') }}</p>
                    @else
                        <ul>
                             @foreach($prescriptions as $prescription)
                                <li>
                                    <br/>
                                    <p><strong> {{ $prescription->appointment->medicSchedule->specialty->name }} 
                                       with Dr. {{ $prescription->appointment->medicSchedule->user->profile->first_name}} {{ $prescription->appointment->medicSchedule->user->profile->last_name }}</strong>
                                    </p>
                                    <p>{{ __('Date') }}: {{ ucfirst(\Carbon\Carbon::parse($prescription->date)->translatedFormat('l, j \d\e F \d\e Y')) }}</p>
                                    <p>{{ __('Items') }}:
                                        @foreach($prescription->items as $item)
                                            <li class="text-gray-500 dark:text-gray-400">{{ $item->stockItem->item_name }}  - {{ $item->quantity }} units</li>
                                        @endforeach
                                    </p>
                                    <p>{{ __('Recommendations') }}:
                                        @foreach($prescription->appointment->medicalDiagnostics as $medicalDiagnostic)
                                            <li class="text-gray-500 dark:text-gray-400">{{ $medicalDiagnostic->recommendations }}</li>
                                        @endforeach
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>