@if($isOpenCreate)
    @include('admin.medics.create')
@endif
@if($isOpenEdit)
    @include('admin.medics.edit')
@endif

<x-slot name="header">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Physician management') }}
    </h1>
</x-slot>

<div class="py-2">

    @include('admin.medics.actions')
    @include('admin.medics.menu')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        @if (session()->has('message'))
            <div>{{ session('message') }}</div>
        @endif
            <thead class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Name') }}
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    {{ __('NID') }}
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    {{ __('Phone') }}
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    {{ __('Gender') }}
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    {{ __('Specialty') }}
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
            @foreach($medics as $medic)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="{{ $medic->profile_photo_url }}"
                             alt="{{ $medic->first_name }}">
                        <div class="ps-3">
                            <div
                                class="text-base font-semibold">{{ $medic->profile->first_name }} {{ $medic->profile->last_name }}</div>
                            <div class="font-normal text-gray-500">{{ $medic->email }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4 text-center">{{ $medic->profile->nid }}</td>
                    <td class="px-6 py-4 text-center">{{ $medic->profile->phone }}</td>
                    <td class="px-6 py-4 text-center">{{ $medic->profile->gender_name }}</td>
                    <td class="px-6 py-4 text-center">{{ implode(', ', $medic->specialties->pluck('name')->toArray()) }}</td>
                    <td class="px-6 py-4 text-center">{{ $medic->status_label }}</td>
                    <td class="px-6 py-4 text-center">
                        <button wire:click="edit({{ $medic->id }})" class="text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></button>
                        <button wire:click="delete({{ $medic->id }})" class="text-red-600 dark:text-red-500"><x-monoicon-delete-alt width="20" height="20" /></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $medics->links() }}
    </div>

</div>
