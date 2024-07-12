    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Patient Medical History') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($patient)
                    <h3 class="text-lg font-medium text-gray-900">{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $patient->profile->age }} {{ __('years') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $patient->profile->address }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $patient->profile->phone }}</p>

                    <h4 class="mt-6 text-md font-medium text-gray-900">{{ __('Previous Diagnoses') }}</h4>
                    <ul class="mt-2">
                        @foreach ($patient->appointments as $appointment)
                        {{ $appointment->service_date }} - {{ $appointment->medicSchedule->specialty->name }}
                            <h4 class="mt-4 text-md font-medium text-gray-900">{{ __('Diagnoses') }}</h4>
                            @foreach ($appointment->medicalDiagnostics as $medicalDiagnostic)
                                @foreach ($medicalDiagnostic->diagnostics as $diagnostic)
                                    <li>{{ $diagnostic->description }}</li>
                                @endforeach
                            @endforeach

                            <h4 class="mt-4 text-md font-medium text-gray-900">{{ __('Medical Exams') }}</h4>
                            @foreach ($appointment->medicalDiagnostics as $medicalDiagnostic)
                                @foreach ($medicalDiagnostic->medicalTests as $medicalTest)
                                    <li>{{ $medicalTest->name }}</li>
                                @endforeach
                            @endforeach

                            <h4 class="mt-4 text-md font-medium text-gray-900">{{ __('Prescriptions') }}</h4>
                            @foreach ($appointment->prescriptions as $prescription)
                                @foreach ($prescription->items as $item)
                                    <li>{{ $item->stockItem->item_name }} - {{ $item->quantity }} units</li>
                                @endforeach
                            @endforeach

                        @endforeach
                    </ul>
                @else
                    <p>{{ __('Patient not found') }}</p>
                @endif
            </div>
        </div>
    </div>
