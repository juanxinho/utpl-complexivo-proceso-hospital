<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Invoice details') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <h1>Invoice Details</h1>
                <p><strong>Patient:</strong> {{ $invoice->patient->name }}</p>
                <p><strong>Notes:</strong> {{ $invoice->notes }}</p>
                <h3>Items</h3>
                <ul>
                    @foreach($invoice->items as $item)
                        <li>{{ $item->stockItem->name }} - {{ $item->quantity }} - ${{ $item->price }}</li>
                    @endforeach
                </ul>
                <form action="{{ route('invoices.addItems', $invoice) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="items" class="form-label">Add Items</label>
                        <div id="items">
                            <div class="item">
                                <select name="items[0][stock_item_id]" class="form-control">
                                    @foreach($stockItems as $stockItem)
                                        <option value="{{ $stockItem->id }}">{{ $stockItem->name }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="items[0][quantity]" class="form-control" placeholder="Quantity">
                                <input type="number" name="items[0][price]" class="form-control" placeholder="Price">
                            </div>
                        </div>
                        <button type="button" id="add-item" class="btn btn-secondary mt-3">Add Item</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Items</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.getElementById('add-item').addEventListener('click', function() {
        var items = document.getElementById('items');
        var itemCount = items.getElementsByClassName('item').length;
        var newItem = document.createElement('div');
        newItem.className = 'item';
        newItem.innerHTML = `
        <select name="items[${itemCount}][stock_item_id]" class="form-control">
            @foreach($stockItems as $stockItem)
        <option value="{{ $stockItem->id }}">{{ $stockItem->name }}</option>
            @endforeach
        </select>
        <input type="number" name="items[${itemCount}][quantity]" class="form-control" placeholder="Quantity">
        <input type="number" name="items[${itemCount}][price]" class="form-control" placeholder="Price">
    `;
        items.appendChild(newItem);
    });
</script>
