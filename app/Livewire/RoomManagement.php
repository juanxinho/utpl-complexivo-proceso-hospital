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
    public $medics;
    public $selectedRoom = null;
    public $selectedMedic = null;
    public $assignmentDate;

    protected $rules = [
        'code' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'nullable|string',
        'status' => 'required|integer|in:0,1',
    ];

    public function mount()
    {
        $this->searchStatuses = ['0' => __('Unavailable'), '1' => __('Available')];
        $this->medics = User::role('medic')->get();
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $rooms = Room::query()
            ->when($this->selectedStatus !== null && $this->selectedStatus !== '', function ($query) {
                $query->where('status', $this->selectedStatus);
            })
            ->where(function($query) use ($searchTerm) {
                $query->where('code', 'like', $searchTerm)
                    ->orWhere('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('location', 'like', $searchTerm);
            })
            ->paginate(10);

        return view('admin.rooms.index', compact('rooms'))->layout('layouts.app');
    }

    public function updatedSearchTerm() {
        $this->render();
    }

    public function clearFilters()
    {
        $this->searchTerm = '';
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
