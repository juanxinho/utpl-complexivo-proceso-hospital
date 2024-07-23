@if($isOpenCreate)
    @include('admin.rooms.create')
@endif
@if($isOpenEdit)
    @include('admin.rooms.edit')
@endif

<x-slot name="header">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Manage Rooms') }}
    </h1>
</x-slot>

<div class="py-2">

    @include('admin.rooms.actions')
    @include('admin.rooms.menu')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            @if (session()->has('message'))
                <div>{{ session('message') }}</div>
            @endif
            <thead class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Room Code') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Room Name') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Description') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Location') }}
                </th>
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Status') }}
                </th>

                <th scope="col" class="px-6 py-3 text-center">
                    {{ __('Actions') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $room->code }}</td>
                    <td class="px-6 py-4">{{ $room->name }}</td>
                    <td class="px-6 py-4">{{ $room->description }}</td>
                    <td class="px-6 py-4">{{ $room->location }}</td>
                    <td class="px-6 py-4">
                        @if($room->status == 1 )
                            <x-bordered-badge color="green" text="{{ __('Available') }}" />
                        @else
                            <x-bordered-badge color="red" text="{{ __('Available') }}" />
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button wire:click="edit({{ $room->id }})" class="text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></button>
                        <button wire:click="delete({{ $room->id }})" class="text-red-600 dark:text-red-500"><x-monoicon-delete-alt width="20" height="20" /></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $rooms->links() }}
    </div>

</div>
