<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Patients management') }}
    </h2>
</x-slot>

<div class="py-2 md:py-12">

    <button wire:click="create()" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nuevo Paciente</button>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">{{ __('Search') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar pacientes">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                    {{ __('Email') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Actions') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients as $patient)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->nid }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->age }} {{ __('years') }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->gender }}</td>
                    <td class="px-6 py-4">{{ $patient->profile->phone }}</td>
                    <td class="px-6 py-4">{{ $patient->email }}</td>
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

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <form>
                        <div class="mb-4">
                            <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('First name') }}:</label>
                            <input type="text" id="first_name" wire:model="first_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Last name') }}:</label>
                            <input type="text" id="last_name" wire:model="last_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="nid" class="block text-gray-700 text-sm font-bold mb-2">{{ __('NID') }}:</label>
                            <input type="text" id="nid" wire:model="nid" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('nid') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Phone') }}:</label>
                            <input type="text" id="phone" wire:model="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Gender') }}:</label>
                            <select id="gender" wire:model="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Seleccione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Date of birth') }}:</label>
                            <input type="date" id="dob" wire:model="dob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('dob') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email') }}:</label>
                            <input type="email" id="email" wire:model="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button wire:click="closeModal()" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Cancel') }}
                            </button>
                            <button wire:click.prevent="store()" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

