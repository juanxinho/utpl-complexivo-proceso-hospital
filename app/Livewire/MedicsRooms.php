<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\User;
use App\Models\Specialty;
use App\Models\MedicRoom;
use Illuminate\Support\Facades\DB;

class MedicsRooms extends Component
{
    use WithPagination;

    public $code, $name, $description, $idMedicRoom, $location, $status = 1;
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
    public $medicsRoom = [];
    public $availableRooms = [];

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

        /* $assigned_rooms = Room::leftJoin('medic_room', 'rooms.id', '=', 'medic_room.room_id')
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
            ->paginate(10); */


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

        return view('admin.medics.rooms.index', compact('assigned_rooms'))->layout('layouts.app');
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

        //Obtener lista de consultorios que no  están asignados
        $this->availableRooms = Room::where('status', 1)->pluck('name', 'id');
        
        //Obtener lista de médicos que no tienen consultorio asignado
        $medicRoomUserIds = MedicRoom::pluck('user_id');
        $this->medicsRoom = User::with('profile', 'medicRooms.room')
            ->where('status', 1)
            ->role('medic')
            ->whereNotIn('id', $medicRoomUserIds)
            ->get()
            ->pluck('full_name', 'id');

        $this->isOpenCreate = true;

    }

    public function store()
    {
        //$this->validate();

        MedicRoom::create([
            'user_id' => $this->selectedMedic,
            'room_id' => $this->selectedRoom,
            'assigned_date' => now(),
        ]);

        //Actualizando el estado del consultario a no disponible
        $room = Room::findOrFail($this->selectedRoom);
        $room->update([
            'status' => 0,
        ]);

        session()->flash('message', 'Room Medic created successfully.');

        $this->resetInputFields();
        $this->isOpenCreate = false;
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $medicroom = MedicRoom::where('room_id', $id)->first();
        $medicRoomUserIds = MedicRoom::whereNotIn('id', [$medicroom->id])->pluck('user_id');
        $this->idMedicRoom = $medicroom->id;
        $this->code = $room->code;
        $this->name = $room->name;
        $this->status = $room->status;
        $this->selectedMedic= $medicroom->user_id;

        //Obtener lista de médicos que no tienen consultorio asignado
        $this->medicsRoom = User::with('profile', 'medicRooms.room')
            ->where('status', 1)
            ->role('medic')
            ->whereNotIn('id', $medicRoomUserIds)
            ->get()
            ->pluck('full_name', 'id');

        $this->isOpenEdit = true;

    }

    public function update()
    {
        //$this->validate();
        $medicroom = MedicRoom::findOrFail($this->idMedicRoom);
        $medicroom->update([
            'user_id' => $this->selectedMedic,
            'assigned_date' => now(),
        ]);

        session()->flash('message', 'Medic - Room updated successfully.');

        $this->resetInputFields();
        $this->isOpenEdit = false;
    }

    public function delete($id)
    {
        $medicroom = MedicRoom::where('room_id', $id)->first();
        $medicroom->delete();

        //Actualizando el estado del consultario a disponible
        $room = Room::findOrFail($id);
        $room->update([
            'status' => 1,
        ]);

        session()->flash('message', 'Room Medic deleted successfully.');
    }
}
