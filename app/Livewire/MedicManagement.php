<?php

namespace App\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\City;
use App\Models\Country;
use App\Models\Day;
use App\Models\MedicRoom;
use App\Models\Schedule;
use App\Models\State;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use App\Models\MedicSchedule;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class MedicManagement extends Component
{
    use WithPagination;
    use PasswordValidationRules;

    public $medic, $profile, $email, $password, $roles, $id_specialties, $specialties, $searchSpecialties, $selectedSpecialties = [], $searchStatuses, $selectedStatus, $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $isOpenAssign = false;
    public $searchTerm = '';
    public $countries;
    public $states = [];
    public $cities = [];
    public $rooms = [];
    public $medicsRoom = [];
    public $selectedMedic = null;
    public $selectedRoom;
    public $availableRooms = [];
    public $assignmentDate;

    /**
     * Initialize component data.
     *
     * This function is called when the component is mounted and initializes
     * the search specialties, specialties, search statuses, and countries.
     *
     * @return void
     */
    public function mount()
    {
        $this->searchSpecialties = Specialty::pluck('name', 'id_specialty');
        $this->specialties = Specialty::where('status', 1)->get();
        $this->searchStatuses = ['0' => __('Inactive'), '1' => __('Active')];
        $this->countries = Country::pluck('name', 'id')->map(function ($name) {
            return ucfirst($name);
        });

        if (isset($this->profile['country_id'])) {
            $this->loadStates();
        }

        if (isset($this->profile['state_id'])) {
            $this->loadCities();
        }
    }

    /**
     * Handle updated country ID in profile.
     *
     * This function resets state and city data and loads states
     * when the country ID in the profile is updated.
     *
     * @return void
     */
    public function updatedprofileCountryId()
    {
        $this->profile['state_id'] = null;
        $this->cities = [];
        $this->profile['city_id'] = null;
        $this->states = [];
        $this->loadStates();
    }

    /**
     * Handle updated state ID in profile.
     *
     * This function resets city data and loads cities
     * when the state ID in the profile is updated.
     *
     * @return void
     */
    public function updatedprofileStateId()
    {
        $this->profile['city_id'] = null;
        $this->cities = [];
        $this->loadCities();
    }

    /**
     * Load states based on the selected country.
     *
     * This function retrieves and sets the states associated with
     * the selected country ID in the profile.
     *
     * @return void
     */
    protected function loadStates()
    {
        $this->states = State::where('country_id', $this->profile['country_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }

    /**
     * Load cities based on the selected state.
     *
     * This function retrieves and sets the cities associated with
     * the selected state ID in the profile.
     *
     * @return void
     */
    protected function loadCities()
    {
        $this->cities = City::where('state_id', $this->profile['state_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }

    /**
     * Render the component view.
     *
     * This function retrieves and paginates the medics based on search term,
     * selected specialties, and selected status, then returns the view.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $medics = User::with('profile', 'medicSchedules.schedule', 'medicSchedules.schedule.day', 'medicRooms.room')
            ->when(!empty($this->selectedSpecialties), function ($query) {
                $query->whereHas('specialties', function ($query) {
                    $query->whereIn('specialty.id_specialty', (array) $this->selectedSpecialties);
                });
            })
            ->when($this->selectedStatus !== null && $this->selectedStatus !== '', function ($query) {
                $query->where('status', $this->selectedStatus);
            })
            ->where(function($query) use ($searchTerm) {
                $query->where('email', 'like', $searchTerm)
                    ->orWhereHas('profile', function($query) use ($searchTerm) {
                        $query->where('first_name', 'like', $searchTerm)
                            ->orWhere('last_name', 'like', $searchTerm);
                    });
            })
            ->role('medic')
            ->paginate(10);

        $specialties = Specialty::all();

        return view('admin.medics.index', compact('medics', 'specialties'))->layout('layouts.app');
    }

    /**
     * Handle updated selected specialty.
     *
     * This function re-renders the component when the selected specialty is updated.
     *
     * @return void
     */
    public function updatedSelectedSpecialty() {
        $this->render();
    }

    /**
     * Handle updated selected status.
     *
     * This function re-renders the component when the selected status is updated.
     *
     * @return void
     */
    public function updatedSelectedStatus() {
        $this->render();
    }

    /**
     * Handle updated search term.
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
        $this->isOpenAssign = false;
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
        $this->id = null;
        $this->email = '';
        $this->password = '';
        $this->profile['first_name'] = '';
        $this->profile['last_name'] = '';
        $this->profile['nid'] = '';
        $this->profile['phone'] = '';
        $this->profile['gender'] = '';
        $this->profile['dob'] = null;
        $this->profile['country_id'] = null;
        $this->profile['state_id'] = null;
        $this->profile['city_id'] = null;
        $this->profile['address'] = '';
        $this->id_specialties = [];
        $this->selectedSpecialties = [];
        $this->selectedMedic = null;
        $this->availableRooms = null;
        $this->assignmentDate = null;
    }

    /**
     * Show the form for creating a new medic.
     *
     * This function resets input fields and sets the modal window for creation to be open.
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();
        $this->roles = Role::where('name', 'medic')->get();
        $this->isOpenCreate = true;
    }

    /**
     * Store a newly created medic in storage.
     *
     * This function validates and stores a new medic in the database.
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->id,
            //'password' => $this->passwordRules(),
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => ['required', 'string', 'max:13', 'unique:profile,nid,' . $this->id . ',id_profile', new EcuadorCedulaOrRuc],
            'profile.phone' => ['required', 'string', 'max:10', new EcuadorPhone],
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
            'profile.country_id' => ['required', 'exists:countries,id'],
            'profile.state_id' => ['required', 'exists:states,id'],
            'profile.city_id' => ['required', 'exists:cities,id'],
            'id_specialties' => 'required|array|min:1',
        ]);

        $profile = Profile::updateOrCreate(['id_profile' => $this->id], [
            'first_name' => $this->profile['first_name'],
            'last_name' => $this->profile['last_name'],
            'nid' => $this->profile['nid'],
            'phone' => $this->profile['phone'],
            'gender' => $this->profile['gender'],
            'dob' => $this->profile['dob'],
            'country_id' => $this->profile['country_id'],
            'state_id' => $this->profile['state_id'],
            'city_id' => $this->profile['city_id'],
            'address' => $this->profile['address'] ?? null,
            'user_register' => auth()->user()->id,
        ]);

        $user = User::updateOrCreate(['id' => $this->id], [
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);

        $user->assignRole('medic');

        $user->specialties()->sync($this->id_specialties);

        session()->flash('flash.banner', $this->id ? __('Medic successfully updated.') : __('Medic successfully created.'));
        session()->flash('flash.bannerStyle', 'success');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * Show the form for editing the specified medic.
     *
     * This function retrieves the medic details and sets the modal window for editing to be open.
     *
     * @param int $id The ID of the medic to edit.
     * @return void
     */
    public function edit($id)
    {
        $medic = User::with('profile', 'roles', 'specialties', 'medicSchedules.schedule', 'medicSchedules.schedule.day', 'medicRooms.room')->findOrFail($id);

        $this->id = $id;
        $this->profile = $medic->profile->toArray();
        $this->email = $medic->email;
        $this->roles = Role::where('name', 'medic')->get();
        $this->id_specialties = $medic->specialties()->pluck('specialty.id_specialty')->toArray();
        $this->loadStates();
        $this->loadCities();
        $this->isOpenEdit = true;
    }

    /**
     * Deactivate the specified medic.
     *
     * This function sets the status of the medic to inactive.
     *
     * @param int $id The ID of the medic to deactivate.
     * @return void
     */
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 0; // Set status to 0 to mark as inactive
            $user->save(); // Save the change
        }

        session()->flash('flash.banner', __('Medic successfully deactivated.'));
        session()->flash('flash.bannerStyle', 'success');
    }

    /**
     * Show the form for assigning rooms to medics.
     *
     * This function resets input fields and sets the modal window for room assignment to be open.
     *
     * @return void
     */
    public function assignRooms()
    {
        $this->resetInputFields();
        $this->medicsRoom = User::with('profile', 'medicRooms.room')
            ->where('status', 1)
            ->role('medic')
            ->get()
            ->pluck('full_name', 'id');

        $this->availableRooms = Room::where('status', 1)->orWhereHas('room', function ($query) {
            $query->where('user_id', $this->selectedMedic);
        })->pluck('name', 'id');
        $this->isOpenAssign = true;
    }

    /**
     * Handle updated selected medic.
     *
     * This function updates the available rooms when the selected medic is updated.
     *
     * @param int $medicId The ID of the selected medic.
     * @return void
     */
    public function updatedSelectedMedic($medicId)
    {
        $this->selectedRoom = MedicRoom::where('user_id', $medicId)->value('room_id');
        $this->availableRooms = Room::where('status', 1)
            ->orWhere('id', $this->selectedRoom)
            ->pluck('name', 'id');
    }

    /**
     * Store the assigned room for the medic.
     *
     * This function validates and stores the room assignment for the selected medic.
     *
     * @return void
     */
    public function storeAssignRoom()
    {
        $this->validate([
            'availableRooms' => 'required|exists:rooms,id',
            'selectedMedic' => 'required|exists:users,id',
            'assignmentDate' => 'required|date',
        ]);

        MedicRoom::updateOrCreate(
            ['user_id' => $this->selectedMedic],
            ['room_id' => $this->availableRooms, 'assigned_date' => now()]
        );

        Room::where('id', $this->availableRooms)->update(['status' => 0]);

        session()->flash('flash.banner', __('Room assigned successfully.'));
        session()->flash('flash.bannerStyle', 'success');

        $this->closeModal();
        $this->resetInputFields();
    }
}
