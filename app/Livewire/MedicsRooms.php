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

    /**
     * Sort the records by a specified field.
     *
     * This function toggles the sorting direction if the field is the same,
     * otherwise, it sets the sorting field and direction to ascending.
     *
     * @param string $field The field to sort by.
     * @return void
     */
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Initialize the component.
     *
     * This function is called when the component is mounted and initializes
     * the search specialties and search statuses.
     *
     * @return void
     */
    public function mount()
    {
        $this->searchSpecialties = Specialty::where('status', 1)->pluck('name', 'id_specialty');
        $this->searchStatuses = ['0' => __('Unavailable'), '1' => __('Available')];
    }

    /**
     * Render the component view.
     *
     * This function retrieves and filters the rooms based on search term, selected specialties, and selected status,
     * then returns the view with the rooms data.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $assigned_rooms = Room::leftJoin('medic_room', 'rooms.id', '=', 'medic_room.room_id')
            ->leftJoin('users', 'medic_room.user_id', '=', 'users.id')
            ->leftJoin('profile', 'users.id_profile', '=', 'profile.id_profile')
            ->leftJoin('specialty_user', 'users.id', '=', 'specialty_user.id_user')
            ->leftJoin('specialty', 'specialty_user.id_specialty', '=', 'specialty.id_specialty')
            ->select(
                'rooms.*',
                'users.id as user_id',
                'profile.first_name',
                'profile.last_name',
                DB::raw('GROUP_CONCAT(specialty.name SEPARATOR ", ") as specialties'),
                'medic_room.assigned_date'
            )
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
            ->groupBy('rooms.id', 'users.id', 'profile.first_name', 'profile.last_name', 'medic_room.assigned_date')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('admin.medics.rooms.index', compact('assigned_rooms'))->layout('layouts.app');
    }

    /**
     * Handle updates to the selected specialty.
     *
     * This function re-renders the component when the selected specialty is updated.
     *
     * @return void
     */
    public function updatedSelectedSpecialty() {
        $this->render();
    }

    /**
     * Handle updates to the selected status.
     *
     * This function re-renders the component when the selected status is updated.
     *
     * @return void
     */
    public function updatedSelectedStatus() {
        $this->render();
    }

    /**
     * Handle updates to the search term.
     *
     * This function re-renders the component when the search term is updated.
     *
     * @return void
     */
    public function updatedSearchTerm() {
        $this->render();
    }

    /**
     * Clear all filters.
     *
     * This function resets the search term, selected specialties, and selected status.
     *
     * @return void
     */
    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->selectedSpecialties = null;
        $this->selectedStatus = null;
    }

    /**
     * Close the modal windows.
     *
     * This function sets the modal windows to be closed.
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    /**
     * Reset input fields.
     *
     * This function resets all input fields to their default values.
     *
     * @return void
     */
    private function resetInputFields()
    {
        $this->code = '';
        $this->name = '';
        $this->description = '';
        $this->location = '';
        $this->status = 1;
    }

    /**
     * Show the form for creating a new room assignment.
     *
     * This function resets input fields, retrieves available rooms and medics without assignments,
     * and sets the modal window for creation to be open.
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();

        $this->availableRooms = Room::where('status', 1)->pluck('name', 'id');

        $medicRoomUserIds = MedicRoom::pluck('user_id');
        $this->medicsRoom = User::with('profile', 'medicRooms.room')
            ->where('status', 1)
            ->role('medic')
            ->whereNotIn('id', $medicRoomUserIds)
            ->get()
            ->pluck('full_name', 'id');

        $this->isOpenCreate = true;
    }

    /**
     * Store a newly created room assignment.
     *
     * This function validates and stores a new room assignment in the database,
     * updates the room status to unavailable, and resets the input fields.
     *
     * @return void
     */
    public function store()
    {
        MedicRoom::create([
            'user_id' => $this->selectedMedic,
            'room_id' => $this->selectedRoom,
            'assigned_date' => now(),
        ]);

        $room = Room::findOrFail($this->selectedRoom);
        $room->update([
            'status' => 0,
        ]);

        session()->flash('message', 'Room Medic created successfully.');

        $this->resetInputFields();
        $this->isOpenCreate = false;
    }

    /**
     * Show the form for editing the specified room assignment.
     *
     * This function retrieves the room and assignment details and sets the modal window for editing to be open.
     *
     * @param int $id The ID of the room assignment to edit.
     * @return void
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $medicroom = MedicRoom::where('room_id', $id)->first();
        $medicRoomUserIds = MedicRoom::whereNotIn('id', [$medicroom->id])->pluck('user_id');
        $this->idMedicRoom = $medicroom->id;
        $this->code = $room->code;
        $this->name = $room->name;
        $this->status = $room->status;
        $this->selectedMedic = $medicroom->user_id;

        $this->medicsRoom = User::with('profile', 'medicRooms.room')
            ->where('status', 1)
            ->role('medic')
            ->whereNotIn('id', $medicRoomUserIds)
            ->get()
            ->pluck('full_name', 'id');

        $this->isOpenEdit = true;
    }

    /**
     * Update the specified room assignment.
     *
     * This function validates and updates the room assignment in the database,
     * and resets the input fields.
     *
     * @return void
     */
    public function update()
    {
        $medicroom = MedicRoom::findOrFail($this->idMedicRoom);
        $medicroom->update([
            'user_id' => $this->selectedMedic,
            'assigned_date' => now(),
        ]);

        session()->flash('message', 'Medic - Room updated successfully.');

        $this->resetInputFields();
        $this->isOpenEdit = false;
    }

    /**
     * Delete the specified room assignment.
     *
     * This function deletes the room assignment from the database and updates the room status to available.
     *
     * @param int $id The ID of the room assignment to delete.
     * @return void
     */
    public function delete($id)
    {
        $medicroom = MedicRoom::where('room_id', $id)->first();
        $medicroom->delete();

        $room = Room::findOrFail($id);
        $room->update([
            'status' => 1,
        ]);

        session()->flash('message', 'Room Medic deleted successfully.');
    }
}
