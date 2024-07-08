<x-app-layout>

    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Translation manager') }}
        </h1>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <iframe id="iframe" src="{{ route('translations') }}" onload="resizeIframe(this)"></iframe>

                <script>
                    function resizeIframe(iframe) {
                        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
                    }
                </script>
            </div>
        </div>
    </div>
    <style>
        iframe {
            width: 100%;
            border: none;
        }
    </style>
</x-app-layout>
