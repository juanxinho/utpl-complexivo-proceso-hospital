<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Room;
use App\Models\User;
use App\Models\Specialty;
use App\Models\MedicRoom;

class RoomManagement extends Component
{
    use WithPagination;

    public $rooms;
    public $medics;
    public $selectedRoom = null;
    public $selectedMedic = null;
    public $assignmentDate;
    public $sortBy = 'code';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function mount()
    {
        $this->rooms = Room::all();
        $this->medics = User::role('medic')->get();
    }

    public function assignRoom()
    {
        $this->validate([
            'selectedRoom' => 'required|exists:rooms,id',
            'selectedMedic' => 'required|exists:users,id',
            'assignmentDate' => 'required|date',
        ]);

        MedicRoom::create([
            'user_id' => $this->selectedMedic,
            'room_id' => $this->selectedRoom,
            'assigned_date' => $this->assignmentDate,
        ]);

        session()->flash('message', 'Room assigned successfully.');
    }

    public function render()
    {
        $assigned_rooms = Room::leftJoin('medic_room', 'rooms.id', '=', 'medic_room.room_id')
            ->leftJoin('users', 'medic_room.user_id', '=', 'users.id')
            ->leftJoin('profile', 'users.id_profile', '=', 'profile.id_profile')
            ->leftJoin('specialty_user', 'users.id', '=', 'specialty_user.id_user')
            ->leftJoin('specialty', 'specialty_user.id_specialty', '=', 'specialty.id_specialty')
            ->select('rooms.*', 'users.id as user_id', 'profile.first_name', 'profile.last_name', 'specialty.name as specialty_name', 'medic_room.assigned_date')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('admin.rooms.index', compact('assigned_rooms'))->layout('layouts.app');
    }
}
