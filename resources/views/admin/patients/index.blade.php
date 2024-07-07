@if($isOpenCreate)
    @include('admin.patients.create')
@endif
@if($isOpenEdit)
    @include('admin.patients.edit')
@endif

<x-slot name="header">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Patients management') }}
    </h1>
</x-slot>

<div class="py-2">

    @include('admin.patients.menu')
    @include('admin.patients.actions')

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
                    {{ __('NID') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Age') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Gender') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Phone') }}
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
            @foreach($patients as $patient)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="{{ $patient->profile_photo_url }}"
                             alt="{{ $patient->first_name }}">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}</div>
                            <div class="font-normal text-gray-500">{{ $patient->email }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">{{ $patient->profile->nid }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->age }} {{ __('years') }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->gender_name }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->phone }}</td>
                    <td class="px-6 py-4">{{ $patient->status_label }}</td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $patient->id }})" class="text-gray-600 dark:text-gray-300">
                            <x-monoicon-edit-alt width="20" height="20" />
                        </button>
                        <button wire:click="delete({{ $patient->id }})" class="text-red-600 dark:text-red-500">
                            <x-monoicon-delete-alt width="20" height="20" />
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $patients->links() }}
    </div>

</div>

