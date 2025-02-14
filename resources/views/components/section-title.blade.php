<div class="md:col-span-1 flex justify-between">
    <div class="px-0 py-5">
        <h3 class="text-lg font-medium text-gray-900 dark:text-malachite-300">{{ $title }}</h3>

        <p class="mt-1 text-sm text-gray-600">
            {{ $description }}
        </p>
    </div>

    <div class="px-0 py-5">
        {{ $aside ?? '' }}
    </div>
</div>
