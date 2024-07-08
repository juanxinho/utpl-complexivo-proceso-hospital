<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Appointments') }}
        </h1>
    </x-slot>

    <div class="py-2">

        {{--@include('admin.appointments.actions')--}}
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
                    <th scope="col" class="px-6 py-3">
                        {{ __('Date and Time') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Medic') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Patient') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Status') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Actions') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                        <td class="px-6 py-4">{{ $appointment->service_date }} / {{ $appointment->medicSchedule->schedule->time_range }}</td>
                        <td class="px-6 py-4">{{ $appointment->medicSchedule->user->profile->first_name }}</td>
                        <td class="px-6 py-4">{{ $appointment->user->profile->first_name }} {{ $appointment->user->profile->last_name }}</td>
                        <td class="px-6 py-4">{{ $appointment->status }}</td>
                        <td class="px-6 py-4">
                            <a href=""
                               class="bg-malachite-500 hover:bg-malachite-700 text-white font-bold py-2 px-4 rounded">View</a>

                            @if($appointment->status!='attended')
                                <a href=""
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            @endif

                            <form action="" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
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

