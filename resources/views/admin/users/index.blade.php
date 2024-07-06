@if($isOpen)
    @include('admin.users.create')
@endif
@if($isOpenEdit)
    @include('admin.users.edit')
@endif


<x-slot name="header">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Users management') }}
    </h1>
</x-slot>

<div class="py-2">

    @include('admin.users.actions')
    @include('admin.users.menu')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        @if (session()->has('message'))
            <div>{{ session('message') }}</div>
        @endif
            <thead class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Name') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Roles') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Date created') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Actions') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}"
                             alt="{{ $user->first_name }}">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</div>
                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{ implode(', ', $user->getRoleNames()->toArray()) }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{ $user->created_at }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $user->id }})" class="text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></button>
                        <button wire:click="delete({{ $user->id }})" class="text-red-600 dark:text-red-500"><x-monoicon-delete-alt width="20" height="20" /></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>
