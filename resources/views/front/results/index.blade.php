@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Review Results') }}</h1>
        <div class="bg-white p-6 rounded-lg shadow">
            @foreach($results as $result)
                <div class="mb-4">
                    <p>{{ __('Date') }}: {{ $result->date->format('F j, Y') }}</p>
                    <p>{{ __('Type') }}: {{ $result->type }}</p>
                    <p>{{ __('Details') }}: {{ $result->details }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
