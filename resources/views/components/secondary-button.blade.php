<button {{ $attributes->merge(['type' => 'button', 'class' => 'items-center px-4 py-2 bg-white md:dark:bg-transparent border border-malachite-600 dark:border-malachite-300 rounded-md font-bold text-sm text-malachite-600 dark:text-malachite-300 tracking-widest shadow-sm hover:bg-malachite-600 hover:text-white dark:hover:text-gray-800 dark:hover:bg-malachite-300 focus:outline-none focus:ring-2 dark:focus:ring-malachite-300 focus:ring-malachite-600 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
