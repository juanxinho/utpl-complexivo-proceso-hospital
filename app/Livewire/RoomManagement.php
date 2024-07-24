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

    /**
     * Initialize the component with default values.
     *
     * This function is called when the component is mounted and initializes
     * the list of medics and search statuses.
     *
     * @return void
     */
    public function mount()
    {
        $this->searchStatuses = ['0' => __('Unavailable'), '1' => __('Available')];
        $this->medics = User::role('medic')->get();
    }

    /**
     * Render the component view.
     *
     * This function retrieves the rooms based on the search term and selected status,
     * and returns the view for the component.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
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

    /**
     * Update the search results when the search term is updated.
     *
     * This function is called when the search term is updated
     * and re-renders the component with the new search results.
     *
     * @return void
     */
    public function updatedSearchTerm()
    {
        $this->render();
    }

    /**
     * Clear all filters and reset the search term and selected status.
     *
     * This function clears the search term and selected status, effectively resetting the filters.
     *
     * @return void
     */
    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->selectedStatus = null;
    }

    /**
     * Close the modal dialogs for creating and editing rooms.
     *
     * This function closes the modals for creating and editing rooms.
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    /**
     * Reset the input fields to their default values.
     *
     * This function resets the input fields for the room form to their default values.
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
     * Open the modal for creating a new room.
     *
     * This function opens the modal for creating a new room and resets the input fields.
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();
        $this->isOpenCreate = true;
    }

    /**
     * Store a new room in the database.
     *
     * This function validates the input data and creates a new room in the database.
     *
     * @return void
     */
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

        session()->flash('flash.banner', __('Room created successfully.'));
        session()->flash('flash.bannerStyle', 'success');

        $this->resetInputFields();
        $this->isOpenCreate = false;
    }

    /**
     * Open the modal for editing an existing room.
     *
     * This function finds the room by its ID and populates the input fields with its data.
     *
     * @param int $id The ID of the room to be edited.
     * @return void
     */
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

    /**
     * Update an existing room in the database.
     *
     * This function validates the input data and updates the room in the database.
     *
     * @return void
     */
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

        session()->flash('flash.banner', __('Room updated successfully.'));
        session()->flash('flash.bannerStyle', 'success');

        $this->resetInputFields();
        $this->isOpenEdit = false;
    }

    /**
     * Delete an existing room from the database.
     *
     * This function finds the room by its ID and deletes it from the database.
     *
     * @param int $id The ID of the room to be deleted.
     * @return void
     */
    public function delete($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        session()->flash('flash.banner', __('Room deleted successfully.'));
        session()->flash('flash.bannerStyle', 'success');
    }
}
