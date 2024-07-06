@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Assign Specialties to') }} {{ $medic->name }}</h1>
        <form action="{{ route('medics.store.specialties', $medic->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="specialties" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Specialties') }}:</label>
                <select multiple id="specialties" name="specialties[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}" {{ $medic->specialties->contains($specialty->id) ? 'selected' : '' }}>{{ $specialty->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Assign Specialties') }}
            </button>
        </form>
    </div>
@endsection
