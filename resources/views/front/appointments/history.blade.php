@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Appointment History') }}</h1>
        <div class="bg-white p-6 rounded-lg shadow">
            @foreach($appointments as $appointment)
                <div class="mb-4">
                    <p>{{ __('Date') }}: {{ $appointment->date->format('F j, Y, g:i a') }}</p>
                    <p>{{ __('Doctor') }}: {{ $appointment->doctor->profile->first_name }} {{ $appointment->doctor->profile->last_name }}</p>
                    <p>{{ __('Specialty') }}: {{ $appointment->specialty->name }}</p>
                    <p>{{ __('Status') }}: {{ $appointment->status }}</p>
                    <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-600 hover:underline">{{ __('View Details') }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
