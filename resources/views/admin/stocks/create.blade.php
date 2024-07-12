<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Stocks management') }}
        </h1>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Add New Stock Item') }}
            </h2>
        </div>

        @include('admin.stocks.menu')

        <div class="mx-auto sm:px-6 lg:px-2">
            <div class="flex flex-col">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.stocks.store') }}" method="POST">
                        <div
                            class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            @csrf
                            <div class="mb-4">
                                <x-label for="item_name" value="{{ __('Item Name') }}"/>
                                <x-input id="item_name" class="block mt-1 w-full" type="text" name="item_name"
                                         :value="old('item_name')" required autofocus autocomplete="item_name"/>
                            </div>
                            <div class="mb-4">
                                <x-label for="quantity" value="{{ __('Quantity') }}"/>
                                <x-input id="quantity" class="block mt-1 w-full" type="text" name="quantity"
                                         :value="old('quantity')" autofocus autocomplete="quantity"/>
                            </div>
                            <div class="mb-4">
                                <x-label for="price" value="{{ __('Price') }}"/>
                                <x-input id="price" class="block mt-1 w-full" type="text" name="price"
                                         :value="old('price')" autofocus autocomplete="price"/>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <x-button class="me-2" type="submit">{{ __('Save') }}</x-button>
                            <x-secondary-button type="button"
                                                onclick="redirectToStocksIndex()">{{ __('Cancel') }}</x-secondary-button>
                        </div>
                        @push('scripts')
                            <script>
                                function redirectToStocksIndex() {
                                    window.location.href = "{{ route('admin.stocks.index') }}";
                                }
                            </script>
                        @endpush
                        @stack('scripts')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
