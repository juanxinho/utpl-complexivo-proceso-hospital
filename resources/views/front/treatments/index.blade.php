@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Review My Treatments') }}</h1>
        <div class="bg-white p-6 rounded-lg shadow">
            @foreach($treatments as $treatment)
                <div class="mb-4">
                    <p>{{ __('Date') }}: {{ $treatment->date->format('F j, Y') }}</p>
                    <p>{{ __('Treatment') }}: {{ $treatment->treatment }}</p>
                    <p>{{ __('Details') }}: {{ $treatment->details }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
