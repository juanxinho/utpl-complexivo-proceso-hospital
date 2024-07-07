<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Specialties') }}
        </h1>
    </x-slot>

    <div class="py-2">

        @if (session('success'))
            <div class="mb-4 text-malachite-600 dark:text-malachite-300">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.specialties.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Create New Specialty') }}
        </a>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Abbreviation') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Description') }}
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
                @foreach ($specialties as $specialty)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ __($specialty->name) }}</td>
                        <td class="px-6 py-4">{{ $specialty->abbreviation }}</td>
                        <td class="px-6 py-4">{{ __($specialty->description) }}</td>
                        <td class="px-6 py-4">{{ $specialty->status ? __('Active') : __('Inactive') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.specialties.show', $specialty->id_specialty) }}" class="inline-block text-gray-600 dark:text-gray-300"><x-monoicon-eye width="20" height="20" /></a>
                            <a href="{{ route('admin.specialties.edit', $specialty->id_specialty) }}" class="inline-block text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></a>
                            <form action="{{ route('admin.specialties.destroy', $specialty->id_specialty) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-500" onclick="return confirm('{{ __('¿Está seguro de que desea eliminar esta specialty?') }}')">
                                    <x-monoicon-delete-alt width="20" height="20" />
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
