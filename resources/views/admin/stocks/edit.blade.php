@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $stock ?? false ? __('Edit Stock Item') : __('Add New Stock Item') }}</h1>
        <form action="{{ $stock ?? false ? route('stocks.update', $stock) : route('stocks.store') }}" method="POST">
            @csrf
            @if($stock ?? false)
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="item_name">{{ __('Item Name') }}</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $stock->item_name ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">{{ __('Quantity') }}</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $stock->quantity ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="price">{{ __('Price') }}</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $stock->price ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ $stock ?? false ? __('Update') : __('Save') }}</button>
        </form>
    </div>
@endsection
