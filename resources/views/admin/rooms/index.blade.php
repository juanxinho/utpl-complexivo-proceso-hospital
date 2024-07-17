<!-- resources/views/livewire/index.blade.php -->
<x-slot name="header">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Manage Rooms') }}
    </h1>
</x-slot>

<div class="py-2">
    <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            {{ __('Room Assignments') }}
            @if (session()->has('message'))
                <div>{{ session('message') }}</div>
            @endif
        </h2>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('code')">{{ __('Room Code') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('name')">{{ __('Room Name') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('description')">{{ __('Description') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('location')">{{ __('Location') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('status')">{{ __('Status') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('first_name')">{{ __('Assigned Medic') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('specialty_name')">{{ __('Specialty') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('assigned_date')">{{ __('Assigned Date') }}</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($assigned_rooms as $room)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $room->code }}</td>
                    <td class="px-6 py-4">{{ $room->name }}</td>
                    <td class="px-6 py-4">{{ $room->description }}</td>
                    <td class="px-6 py-4">{{ $room->location }}</td>
                    <td class="px-6 py-4">{{ $room->status == 1 ? 'Available' : 'Not Available' }}</td>
                    <td class="px-6 py-4">{{ $room->first_name ? $room->first_name . ' ' . $room->last_name : '-' }}</td>
                    <td class="px-6 py-4">{{ $room->specialty_name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $room->assigned_date ? \Carbon\Carbon::parse($room->assigned_date)->format('Y-m-d') : '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $assigned_rooms->links() }}
    </div>

</div>
