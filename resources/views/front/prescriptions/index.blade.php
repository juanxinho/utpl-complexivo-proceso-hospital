@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Review Prescriptions') }}</h1>
        <div class="bg-white p-6 rounded-lg shadow">
            @foreach($prescriptions as $prescription)
                <div class="mb-4">
                    <p>{{ __('Date') }}: {{ $prescription->date->format('F j, Y') }}</p>
                    <p>{{ __('Medication') }}: {{ $prescription->medication }}</p>
                    <p>{{ __('Dosage') }}: {{ $prescription->dosage }}</p>
                    <p>{{ __('Instructions') }}: {{ $prescription->instructions }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
