<form wire:submit.prevent="assign_room">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        <div>
            <x-label for="selectedMedic" value="{{ __('Select Medic') }}" />
            <x-select id="selectedMedic" name="selectedMedic" wire:model="selectedMedic">
                <option value="">{{ __('Select a Medic') }}</option>
                @foreach($medics as $medic)
                    <option value="{{ $medic->id }}">{{ $medic->profile->first_name }} {{ $medic->profile->last_name }}</option>
                @endforeach
            </x-select>
            @error('selectedMedic') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <x-label for="selectedRoom" value="{{ __('Select Room') }}" />
            <x-select id="selectedRoom" name="selectedRoom" wire:model="selectedRoom">
                <option value="">{{ __('Select a Room') }}</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </x-select>
            @error('selectedRoom') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <x-label for="assignmentDate" value="{{ __('Assignment Date') }}" />
            <x-input id="assignmentDate" name="assignmentDate" type="date" wire:model="assignmentDate" />
            @error('assignmentDate') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-4">
        <x-button>{{ __('Assign Room') }}</x-button>
    </div>
</form>
