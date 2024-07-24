<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Diagnostics Management') }}
        </h1>
    </x-slot>

    <div class="py-2">

        @include('admin.diagnostics.actions')
        @include('admin.diagnostics.menu')

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                @if (session()->has('message'))
                    <div>{{ session('message') }}</div>
                @endif
                <thead
                    class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('Code') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('Description') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($diagnostics->isEmpty())
                    <p>{{ __('No diagnostics found.') }}</p>
                @else
                    @foreach ($diagnostics as $diagnostic)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $diagnostic->code }}</td>
                            <td class="px-6 py-4 text-center">{{ $diagnostic->description }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.diagnostics.edit',$diagnostic->id) }}"
                                   class="inline-block text-gray-600 dark:text-gray-300">
                                    <x-monoicon-edit-alt width="20" height="20"/>
                                </a>
                                <form action="{{ route('admin.diagnostics.destroy', $diagnostic->id) }}"
                                      method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-500"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this diagnostic?') }}')">
                                        <x-monoicon-delete-alt width="20" height="20"/>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $diagnostics->links() }}
        </div>
    </div>
</x-app-layout>
