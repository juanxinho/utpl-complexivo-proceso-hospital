<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Diagnostics Management') }}
        </h1>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Edit Diagnostic Detail') }}
            </h2>
        </div>
        @include('admin.diagnostics.menu')
        <div class="mx-auto sm:px-6 lg:px-2">
            <div class="flex flex-col">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.diagnostics.update', $diagnostic->id) }}" method="POST">
                        <div
                            class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <x-label for="code" value="{{ __('Code') }}"/>
                                <x-input id="code" class="block mt-1 w-full" type="text" name="code"
                                         value="{{ $diagnostic->code }}"
                                         required autofocus/>
                                <x-input-error for="code" class="mt-2"/>
                            </div>
                            <div class="mb-4">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <textarea rows="3" id="description" name="description"
                                          class="dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm w-full">
                                    {{ $diagnostic->description }}
                                </textarea>
                                <x-input-error for="description" class="mt-2"/>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <x-button class="me-2" type="submit">{{ __('Save') }}</x-button>
                            <x-secondary-button type="button"
                                                onclick="redirectToDiagnosticsIndex()">{{ __('Cancel') }}</x-secondary-button>
                        </div>
                        @push('scripts')
                            <script>
                                function redirectToDiagnosticsIndex() {
                                    window.location.href = "{{ route('admin.diagnostics.index') }}";
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
