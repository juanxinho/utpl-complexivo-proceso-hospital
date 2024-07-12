    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Medical History') }}
        </h2>

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
                                @if($appointment->diagnostics)
                                    @foreach ($appointment->diagnostics as $diagnostic)
                                        <li>{{ $diagnostic->description['en'] }}</li>
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>

                        <h4 class="mt-6 text-md font-medium text-gray-900">{{ __('Medical Exams') }}</h4>
                        <!-- Aquí se mostrarían los exámenes médicos asociados -->

                        <h4 class="mt-6 text-md font-medium text-gray-900">{{ __('Prescriptions') }}</h4>
                        <ul class="mt-2">
                            @foreach ($patient->appointments as $appointment)
                                @if($appointment->prescriptions)
                                    @foreach ($appointment->prescriptions as $prescription)
                                        @foreach ($prescription->items as $item)
                                            <li>{{ $item->stock->item_name }} - {{ $item->quantity }} units</li>
                                        @endforeach
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('Patient not found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
