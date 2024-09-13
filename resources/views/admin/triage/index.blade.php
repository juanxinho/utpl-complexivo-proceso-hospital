<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            Lista de Triajes
        </h1>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            </h2>
        </div>

        @include('admin.triage.menu')
        @include('admin.triage.actions')

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">Paciente</th>
                    <th scope="col" class="px-6 py-3">Frecuencia Cardíaca</th>
                    <th scope="col" class="px-6 py-3">Frecuencia Respiratoria</th>
                    <th scope="col" class="px-6 py-3">Presión Arterial</th>
                    <th scope="col" class="px-6 py-3">Temperatura</th>
                    <th scope="col" class="px-6 py-3">SpO2</th>
                    <th scope="col" class="px-6 py-3">Prioridad</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($triages as $triaje)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $triaje->patient->full_name }}</td>
                        <td class="px-6 py-4 text-center">{{ $triaje->heart_rate }}</td>
                        <td class="px-6 py-4 text-center">{{ $triaje->respiratory_rate }}</td>
                        <td class="px-6 py-4 text-center">{{ $triaje->systolic_blood_pressure }}/{{ $triaje->diastolic_blood_pressure }}</td>
                        <td class="px-6 py-4 text-center">{{ $triaje->temperature }}°C</td>
                        <td class="px-6 py-4 text-center">{{ $triaje->spo2 }}%</td>
                        <td class="px-6 py-4 text-center">{{ $triaje->priority }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.triage.edit', $triaje->id) }}" class="inline-block text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></a>
                            <form action="{{ route('admin.triage.destroy', $triaje->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block text-red-600 dark:text-red-500"><x-monoicon-delete-alt width="20" height="20" /></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $triages->links() }}
        </div>
    </div>
</x-app-layout>
