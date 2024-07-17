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

    public $code, $name, $description, $location, $status = 1;
    public $id_specialties, $specialties, $searchSpecialties, $selectedSpecialties = [], $searchStatuses, $selectedStatus;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';
    public $rooms;
    public $medics;
    public $selectedRoom = null;
    public $selectedMedic = null;
    public $assignmentDate;
    public $sortBy = 'code';
    public $sortDirection = 'asc';

    protected $rules = [
        'code' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'nullable|string',
        'status' => 'required|integer|in:0,1',
    ];

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
        $this->searchSpecialties = Specialty::pluck('name', 'id_specialty');
        $this->specialties = Specialty::where('status', 1)->get();
        $this->searchStatuses = ['0' => __('Unavailable'), '1' => __('Available')];
        $this->rooms = Room::all();
        $this->medics = User::role('medic')->get();
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $assigned_rooms = Room::leftJoin('medic_room', 'rooms.id', '=', 'medic_room.room_id')
            ->leftJoin('users', 'medic_room.user_id', '=', 'users.id')
            ->leftJoin('profile', 'users.id_profile', '=', 'profile.id_profile')
            ->leftJoin('specialty_user', 'users.id', '=', 'specialty_user.id_user')
            ->leftJoin('specialty', 'specialty_user.id_specialty', '=', 'specialty.id_specialty')
            ->select('rooms.*', 'users.id as user_id', 'profile.first_name', 'profile.last_name', 'specialty.name as specialty_name', 'medic_room.assigned_date')
            ->when(!empty($this->selectedSpecialties), function ($query) {
                $query->whereIn('specialty.id_specialty', (array) $this->selectedSpecialties);
            })
            ->when($this->selectedStatus !== null && $this->selectedStatus !== '', function ($query) {
                $query->where('rooms.status', $this->selectedStatus);
            })
            ->where(function($query) use ($searchTerm) {
                $query->where('rooms.code', 'like', $searchTerm)
                    ->orWhere('rooms.name', 'like', $searchTerm)
                    ->orWhere('rooms.description', 'like', $searchTerm)
                    ->orWhere('rooms.location', 'like', $searchTerm)
                    ->orWhere('profile.first_name', 'like', $searchTerm)
                    ->orWhere('profile.last_name', 'like', $searchTerm);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('admin.rooms.index', compact('assigned_rooms'))->layout('layouts.app');
    }

    public function updatedSelectedSpecialty() {
        $this->render();
    }

    public function updatedSelectedStatus() {
        $this->render();
    }

    public function updatedSearchTerm() {
        $this->render();
    }

    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->searchSpecialties = null;
        $this->selectedStatus = null;
    }

    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    private function resetInputFields()
    {
        $this->code = '';
        $this->name = '';
        $this->description = '';
        $this->location = '';
        $this->status = 1;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpenCreate = true;
    }

    public function store()
    {
        $this->validate();

        Room::create([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'status' => 1,
        ]);

        session()->flash('message', 'Room created successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $this->selectedRoom = $room->id;
        $this->code = $room->code;
        $this->name = $room->name;
        $this->description = $room->description;
        $this->location = $room->location;
        $this->status = $room->status;
        $this->isOpenEdit = true;
    }

    public function update()
    {
        $this->validate();

        $room = Room::findOrFail($this->selectedRoom);
        $room->update([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Room updated successfully.');

        $this->resetInputFields();
        $this->isOpenEdit = false;
    }

    public function delete($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        session()->flash('message', 'Room deleted successfully.');
    }
}
