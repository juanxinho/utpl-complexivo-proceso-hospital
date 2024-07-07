<div class="flex items-center justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 gap-1">
    <label for="table-search" class="sr-only">{{ __('Search') }}</label>
    <div class="relative">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <x-monoicon-search class="dark:text-gray-600" width="20" height="20" />
        </div>
        <x-input type="text" id="table-search-users" wire:model.live="searchTerm"
                 class="p-2 ps-10"
                 placeholder="{{ __('Search') }}" />
    </div>
    <div class="relative">
        <div class="flex items-center">
            <x-select id="statusFilter" name="statusFilter" :options="$searchStatuses" wire:model.live="selectedStatus" class="dark:text-gray-600" placeholder="All statuses"/>
        </div>
    </div>
    <button wire:click="clearFilters" class="bg-red-500 text-white py-2 px-4 rounded">{{ __('Clear Filters') }}</button>
</div>
