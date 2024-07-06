<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Select Patient</h3>
                    <form method="GET" action="{{ route('admin.appointments.index') }}">
                        <select name="patient_id" class="mt-1 block w-full">
                            @foreach($patients as $id => $name)
                                <option value="{{ $id }}" {{ request('patient_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Show Appointments</button>
                    </form>

                    @if($appointments->isNotEmpty())
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Upcoming Appointments</h3>
                        <ul>
                            @foreach($appointments as $appointment)
                                <li>
                                    <strong>{{ $appointment->service_date->format('d M Y, H:i') }}</strong> with Dr. {{ $appointment->medic->profile->full_name }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No upcoming appointments.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
