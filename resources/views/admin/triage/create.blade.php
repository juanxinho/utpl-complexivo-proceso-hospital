<x-app-layout>
    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                Registro de Triaje
            </h2>
        </div>
        <div class="mx-auto sm:px-6 lg:px-2">
            <div class="flex flex-col">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.triage.store') }}" method="POST">
                        <div
                            class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-2 gap-4">
                                @csrf
                                <x-label for="patient_id" value="{{ __('Patient') }}"/>
                                <select name="patient_id" class="dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm">
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                                    @endforeach
                                </select>

                                <x-label for="heart_rate" value="Frecuencia Cardíaca (60-100)"/>
                                <x-input type="number" name="heart_rate" min="60"
                                         max="100" required/>

                                <x-label for="respiratory_rate" value="Frecuencia Respiratoria (12-20)"/>
                                <x-input type="number" name="respiratory_rate"
                                         min="12" max="20" required/>

                                <x-label for="systolic_blood_pressure" value="Presión Sistólica (120-129)"/>
                                <x-input type="number"
                                         name="systolic_blood_pressure" min="120" max="129" required/>

                                <x-label for="diastolic_blood_pressure" value="Presión Diastólica (80-84)"/>
                                <x-input type="number"
                                         name="diastolic_blood_pressure" min="80" max="84" required/>

                                <x-label for="temperature" value="Temperatura Corporal (12-40)"/>
                                <x-input type="number" name="temperature" step="0.1"
                                         min="12" max="40" required/>

                                <x-label for="spo2" value="Saturación de Oxígeno (70-100)"/>
                                <x-input type="number" name="spo2" min="70" max="100"
                                         required/>

                                <x-label for="priority" value="Prioridad"/>
                                <select name="priority" class="dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm">
                                    <option value="Alto">Alto
                                    </option>
                                    <option value="Medio">Medio
                                    </option>
                                    <option value="Bajo">Bajo
                                    </option>
                                </select>

                                <x-button class="me-2" type="submit">Registrar Triaje</x-button>
                                <x-secondary-button type="button"
                                                    onclick="redirectToTriageIndex()">{{ __('Cancel') }}</x-secondary-button>
                                @push('scripts')
                                    <script>
                                        function redirectToTriageIndex() {
                                            window.location.href = "{{ route('admin.triage.index') }}";
                                        }
                                    </script>
                                @endpush
                                @stack('scripts')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
