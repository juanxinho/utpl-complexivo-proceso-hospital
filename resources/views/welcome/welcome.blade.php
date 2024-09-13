<x-app-layout>
    <h2 class="text-2xl font-bold mb-4 dark:text-malachite-300">{{ __('Welcome') }}
        , {{ $user->profile->first_name }} {{ $user->profile->last_name }}!</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <!-- Attended Patients Card -->
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h3 class="text-gray-700 text-lg font-semibold">Pacientes atendidos</h3>
                <div class="text-4xl font-semibold text-gray-800">{{ $patientsAttended }}</div>
                <div class="flex items-center">
                    @if($percentageChange >= 0)
                        <span class="text-sm text-green-500 flex items-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M5 13l4 4L19 7"></path></svg>
                {{ number_format($percentageChange, 1) }}% ↑
            </span>
                    @else
                        <span class="text-sm text-red-500 flex items-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M19 11l-4-4L5 17"></path></svg>
                {{ number_format($percentageChange, 1) }}% ↓
            </span>
                    @endif
                    <span class="text-xs text-gray-400 ml-1">En comparación con el trimestre anterior</span>
                </div>
            </div>
        </div>

        <!-- Employees Card -->
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h3 class="text-gray-700 text-lg font-semibold">Personal en servicio</h3>
                <p class="text-4xl font-bold mt-2">{{ $nonPatientUsers }}</p>

                <span class="text-sm {{ $percentageChangeUsers >= 0 ? 'text-green-600' : 'text-red-600' }}">
        {{ $percentageChangeUsers }}%
        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="{{ $percentageChangeUsers >= 0 ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
        </svg>
    </span>
                <span class="text-xs text-gray-400 ml-1">En comparación con el trimestre anterior</span>
            </div>
        </div>
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h3 class="text-gray-700 text-lg font-semibold">Próximas citas</h3>

                <ul>
                    @foreach ($upcomingAppointments as $appointment)
                        <li class="flex items-center justify-between py-2">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-4">
                                    <img src="{{ $appointment->medicSchedule->user->profile_photo_url }}"
                                         alt="{{ $appointment->medicSchedule->user->first_name }}"
                                         class="rounded-full h-10 w-10 object-cover">
                                </div>

                                <div>
                                    <p class="text-sm font-semibold">{{ $appointment->medicSchedule->user->profile->first_name }} {{ $appointment->medicSchedule->user->profile->last_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $appointment->medicSchedule->specialty->name }}</p>
                                    <p class="text-sm text-gray-400 flex justify-items-center">
                                        <x-monoicon-clock width="17" height="17" class="mr-1"/>
                                        {{ $appointment->service_date }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('admin.appointments.index') }}" class="text-sm text-green-500 font-semibold">Ver detalles</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-app-layout>
