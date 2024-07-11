<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Stock Items') }}
        </h1>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            </h2>
        </div>

        @include('admin.stocks.menu')

        @if (session('success'))
            <div class="mb-4 text-malachite-600 dark:text-malachite-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('ID') }}
                    </th>
                    <th scope="col" class="px-6 py-3">{{ __('Item Name') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('Quantity') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('Price') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stocks as $stock)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $stock->id }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ __($stock->item_name) }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $stock->quantity }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            ${{ number_format($stock->price, 2) }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.stocks.edit', $stock) }}"
                               class="inline-block text-gray-600 dark:text-gray-300">
                                <x-monoicon-edit-alt width="20" height="20"/>
                            </a>
                            <form action="{{ route('admin.stocks.destroy', $stock) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block text-red-600 dark:text-red-500">
                                    <x-monoicon-delete-alt width="20" height="20"/>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $stocks->links() }}
        </div>

    </div>
</x-app-layout>
