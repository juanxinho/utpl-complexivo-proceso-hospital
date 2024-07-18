@if($isOpenCreate)
    @include('admin.medics.rooms.create')
@endif
@if($isOpenEdit)
    @include('admin.medics.rooms.edit')
@endif

<x-slot name="header">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Manage Rooms') }}
    </h1>
</x-slot>

<div class="py-2">

    @include('admin.medics.rooms.actions')
    @include('admin.medics.rooms.menu')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            @if (session()->has('message'))
                <div>{{ session('message') }}</div>
            @endif
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
                    <a href="#" wire:click.prevent="sortBy('first_name')">{{ __('Assigned Medic') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('specialty_name')">{{ __('Specialty') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('status')">{{ __('Status') }}</a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="#" wire:click.prevent="sortBy('assigned_date')">{{ __('Assigned Date') }}</a>
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    {{ __('Actions') }}
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
                    <td class="px-6 py-4">{{ $room->first_name ? $room->first_name . ' ' . $room->last_name : '-' }}</td>
                    <td class="px-6 py-4">{{ $room->specialty_name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $room->status == 1 ? __('Available') : __('Not Available') }}</td>
                    <td class="px-6 py-4">{{ $room->assigned_date ? \Carbon\Carbon::parse($room->assigned_date)->format('Y-m-d') : '-' }}</td>
                    <td class="px-6 py-4 text-center">
                    @if($room->first_name )
                        <button wire:click="edit({{ $room->id }})" class="text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></button>
                        <button wire:click="delete({{ $room->id }})" class="text-red-600 dark:text-red-500"><x-monoicon-delete-alt width="20" height="20" /></button>
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $assigned_rooms->links() }}
    </div>

</div>
