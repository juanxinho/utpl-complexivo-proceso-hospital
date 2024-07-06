@if($isOpenNew)
    @include('admin.medics.create')
@endif
@if($isOpen)
    @include('admin.medics.edit')
@endif

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Medic Management') }}
    </h2>
</x-slot>

<div class="py-2">

    @include('admin.medics.menu')
    {{--    @include('admin.users.actions')--}}


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Name') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Email') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Roles') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Actions') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($medics as $medic)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $medic->profile->first_name }} {{ $medic->profile->last_name }}</td>
                    <td class="px-6 py-4">{{ $medic->email }}</td>
                    <td class="px-6 py-4">{{ implode(', ', $medic->getRoleNames()->toArray()) }}</td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $medic->id }})" class="text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></button>
                        <form action="" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-500">
                                <x-monoicon-delete-alt width="20" height="20" />
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $medics->links() }}
        @if (session()->has('message'))
            <div>{{ session('message') }}</div>
        @endif
    </div>
</div>
