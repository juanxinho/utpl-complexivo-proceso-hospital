<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Next Appointments') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($appointments)
            @foreach ($appointments as $appointment)

                <div class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 p-6 rounded-lg shadow flex items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ $appointment->medicSchedule->user->profile_photo_url }}"
                             alt="{{ $appointment->medicSchedule->user->first_name }}"
                             class="rounded-full h-28 w-28 object-cover">
                    </div>
                    <div class="flex-1 min-w-0 ms-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $appointment->medicSchedule->specialty->name }}
                        </h2>
                        <p>{{ $appointment->medicSchedule->user->medicRooms->room->name }}</p>
                        <p>{{ ucfirst(\Carbon\Carbon::parse($appointment->service_date)->translatedFormat('l, j \d\e F \d\e Y')) }} | {{ $appointment->medicSchedule->schedule->time_range }}</p>
                        <p>Dr(a) {{ $appointment->medicSchedule->user->profile->first_name}} {{ $appointment->medicSchedule->user->profile->last_name }}</p>
                    </div>
                </div>
                <br/>
            @endforeach
        @else
            <p>{{ __('No appointment found.') }}</p>
        @endif
    </div>
    </div>

</x-app-layout>
