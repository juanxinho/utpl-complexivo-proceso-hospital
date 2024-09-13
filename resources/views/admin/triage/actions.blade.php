<form id="filterForm" method="GET" action="{{ route('admin.triage.index') }}"
      class="flex items-center justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 gap-1">
    <label for="table-search" class="sr-only">{{ __('Search') }}</label>
    <div class="relative">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <x-monoicon-search class="dark:text-gray-600" width="20" height="20"/>
        </div>
        <x-input type="text" id="searchTerm" name="searchTerm" value="{{ request('searchTerm') }}"
                 class="p-2 ps-10"
                 placeholder="{{ __('Search') }}"/>
    </div>
    <div class="relative">
        <div class="flex items-center">
            <select
                class="dark:text-gray-600 form-control dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm"
                id="statusFilter" name="statusFilter">
                <option value="">Todas las prioridades</option>
                <option value="Alto" {{ request('statusFilter') == 'Alto' ? 'selected' : '' }}>Alto</option>
                <option value="Medio" {{ request('statusFilter') == 'Medio' ? 'selected' : '' }}>Medio</option>
                <option value="Bajo" {{ request('statusFilter') == 'Bajo' ? 'selected' : '' }}>Bajo</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary hidden">{{ __('Filter') }}</button>
    <button type="button" class="bg-red-500 text-white py-2 px-4 rounded"
            id="clearFilters">{{ __('Clear Filters') }}</button>
</form>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filterForm');
            const inputs = filterForm.querySelectorAll('input, select');
            const clearButton = document.getElementById('clearFilters');

            inputs.forEach(input => {
                input.addEventListener('change', function () {
                    filterForm.submit();
                });
            });

            clearButton.addEventListener('click', function () {
                inputs.forEach(input => {
                    if (input.type === 'text' || input.type === 'select-one') {
                        input.value = '';
                    }
                });
                window.location.href = '{{ route('admin.triage.index') }}';
            });
        });
    </script>
@endpush
@stack('scripts')
