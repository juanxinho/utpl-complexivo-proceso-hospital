<a {{ $attributes->merge(['class' => 'items-center px-4 py-2 bg-malachite-600 dark:bg-malachite-300 border border-transparent rounded-md font-semibold text-sm text-white dark:text-gray-800 tracking-widest hover:bg-malachite-700 dark:hover:bg-malachite-400 focus:bg-malachite-700 active:bg-malachite-900 focus:outline-none focus:ring-2 focus:ring-malachite-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
