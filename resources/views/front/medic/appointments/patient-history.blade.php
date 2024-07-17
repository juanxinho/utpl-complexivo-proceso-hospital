<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Patient Medical History') }}
        </h1>
    </x-slot>
    @if($patient)
        <div class="max-w-7xl mx-auto px-0 md:p-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Patient information') }}
            </h2>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-malachite-600 dark:text-malachite-300">{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $patient->profile->age }} {{ __('years') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $patient->profile->address }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $patient->profile->phone }}</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-0 md:p-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Past appointments') }}
            </h2>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div id="accordion-collapse" class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-t-lg" data-accordion="collapse">
                    @foreach ($appointments as $index => $appointment)
                        <h2 id="accordion-collapse-heading-{{ $index }}">
                            <button type="button"
                                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border-b border-gray-100 dark:border-gray-700 text-gray-600 hover:bg-gray-100 hover:dark:bg-gray-300 dark:text-white gap-3"
                                    data-accordion-target="#accordion-collapse-body-{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-controls="accordion-collapse-body-{{ $index }}">
                                <span><b>{{ __('Date')  }}:</b> {{ ucfirst(\Carbon\Carbon::parse($appointment->service_date)->translatedFormat('l, F j Y')) }} - <b>{{ $appointment->medicSchedule->specialty->name }}</b></span>
                                <svg width="20" height="20" data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $index }}" class="{{ $index == 0 ? '' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-{{ $index }}">
                            <div class="p-5 border-b border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                <h4 class="mt-4 text-md font-medium text-gray-900 text-gray-500 dark:text-gray-400">{{ __('Diagnoses') }}</h4>
                                @foreach ($appointment->medicalDiagnostics as $medicalDiagnostic)
                                    @foreach ($medicalDiagnostic->diagnostics as $diagnostic)
                                        <li class="text-gray-500 dark:text-gray-400">{{ $diagnostic->description }}</li>
                                    @endforeach
                                @endforeach

                                <h4 class="mt-4 text-md font-medium text-gray-900 text-gray-500 dark:text-gray-400">{{ __('Medical Exams') }}</h4>
                                @foreach ($appointment->medicalDiagnostics as $medicalDiagnostic)
                                    @foreach ($medicalDiagnostic->medicalTests as $medicalTest)
                                        <li class="text-gray-500 dark:text-gray-400">{{ $medicalTest->name }}</li>
                                    @endforeach
                                @endforeach

                                <h4 class="mt-4 text-md font-medium text-gray-900 text-gray-500 dark:text-gray-400">{{ __('Prescriptions') }}</h4>
                                @foreach ($appointment->prescriptions as $prescription)
                                    @foreach ($prescription->items as $item)
                                        <li class="text-gray-500 dark:text-gray-400">{{ $item->stockItem->item_name }}  - {{ $item->quantity }} units</li>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <x-button onclick="window.history.back()">{{ __('Back') }}</x-button>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <p>{{ __('Patient not found') }}</p>
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <x-button onclick="window.history.back()">{{ __('Back') }}</x-button>
                </div>
            </div>
        </div>
    @endif
</div>
