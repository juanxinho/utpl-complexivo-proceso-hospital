<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Appointments') }}
        </h1>
    </x-slot>

    <div class="py-2">

        @include('admin.appointments.actions')
        @include('admin.appointments.menu')

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @if (session('success'))
                    <div class="mb-4 text-malachite-600 dark:text-malachite-300">
                        {{ session('success') }}
                    </div>
                @endif

                <thead
                    class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Number') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Date') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Time') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Specialty') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Medic') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Patient') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Status') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('Actions') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                        <td class="px-6 py-4 text-center">{{ ucfirst(\Carbon\Carbon::parse($appointment->service_date)->translatedFormat('l, j \d\e F \d\e Y')) }}</td>
                        <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->schedule->time_range }}</td>
                        <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->specialty->name }}</td>
                        <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->user->profile->first_name }} {{ $appointment->medicSchedule->user->profile->last_name }}</td>
                        <td class="px-6 py-4 text-center">{{ $appointment->user->profile->first_name }} {{ $appointment->user->profile->last_name }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($appointment->status == 'scheduled' )
                                <x-bordered-badge color="blue" text="{{ __(ucfirst($appointment->status)) }}" />
                            @elseif($appointment->status == 'attended')
                                <x-bordered-badge color="green" text="{{ __(ucfirst($appointment->status)) }}" />
                            @else
                                <x-bordered-badge color="red" text="{{ __(ucfirst($appointment->status)) }}" />
                            @endif
                            </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.appointments.edit', $appointment->id_appointment) }}"
                               class="inline-block text-gray-600 dark:text-gray-300">
                                <x-monoicon-edit-alt width="20" height="20"/>
                            </a>
                            <form action="{{ route('admin.appointments.destroy', $appointment->id_appointment) }}"
                                  method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-500"
                                        onclick="return confirm('{{ __('Are you sure you want to cancel this appointment?') }}')">
                                    <x-monoicon-close width="20" height="20"/>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
</x-app-layout>

