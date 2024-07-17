<form wire:submit.prevent="assignRoom">
    <div>
        <label for="medic">{{ __('Select Medic') }}</label>
        <select wire:model="selectedMedic" id="medic">
            <option value="">{{ __('Choose Medic') }}</option>
            @foreach($medics as $medic)
                <option value="{{ $medic->id }}">{{ $medic->profile->first_name }} {{ $medic->profile->last_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="room">{{ __('Select Room') }}</label>
        <select wire:model="selectedRoom" id="room">
            <option value="">{{ __('Choose Room') }}</option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="assignmentDate">{{ __('Assignment Date') }}</label>
        <input type="date" wire:model="assignmentDate" id="assignmentDate">
    </div>

    <button type="submit">{{ __('Assign Room') }}</button>
</form>
