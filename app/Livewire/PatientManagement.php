<?php

namespace App\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class PatientManagement extends Component
{
    use WithPagination;
    use PasswordValidationRules;

    public $patient, $profile, $email, $password, $searchStatuses, $selectedStatus, $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';
    public $countries;
    public $states = [];
    public $cities = [];

    /**
     * Initialize the component with search statuses and countries.
     *
     * This function is called when the component is mounted and initializes
     * the search statuses and countries. It also loads states and cities if available.
     *
     * @return void
     */
    public function mount()
    {
        $this->searchStatuses = ['0' => 'Inactive', '1' => 'Active'];
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
     * Update the states when the country changes.
     *
     * This function is called when the country ID is updated in the profile
     * and it loads the corresponding states.
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
     * Update the cities when the state changes.
     *
     * This function is called when the state ID is updated in the profile
     * and it loads the corresponding cities.
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
     * Load the states based on the selected country.
     *
     * This function retrieves and sets the states for the selected country.
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
     * Load the cities based on the selected state.
     *
     * This function retrieves and sets the cities for the selected state.
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
     * This function retrieves and filters the patients based on search term and selected status,
     * then returns the view with the patients data.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $patients = User::with('profile')
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
            ->role('patient')
            ->paginate(10);

        return view('admin.patients.index', compact('patients'))->layout('layouts.app');
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
     * This function resets the search term and selected status.
     *
     * @return void
     */
    public function clearFilters()
    {
        $this->searchTerm = '';
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
        $this->states = [];
        $this->cities = [];
    }

    /**
     * Show the form for creating a new patient.
     *
     * This function resets input fields and sets the modal window for creation to be open.
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();
        $this->isOpenCreate = true;
    }

    /**
     * Store a newly created patient.
     *
     * This function validates and stores a new patient in the database,
     * assigns the patient role, and resets the input fields.
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

        $user->assignRole('patient');

        session()->flash('message',
            $this->id ? __('Patient successfully updated.') : __('Patient successfully created.'));

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * Show the form for editing the specified patient.
     *
     * This function retrieves the patient details and sets the modal window for editing to be open.
     *
     * @param int $id The ID of the patient to edit.
     * @return void
     */
    public function edit($id)
    {
        $patient = User::with('profile')->findOrFail($id);

        $this->id = $id;
        $this->profile = $patient->profile->toArray();
        $this->email = $patient->email;
        // Load states and cities for the selected country and state
        $this->loadStates();
        $this->loadCities();
        $this->isOpenEdit = true;
    }

    /**
     * Delete the specified patient.
     *
     * This function marks the patient as inactive in the database.
     *
     * @param int $id The ID of the patient to delete.
     * @return void
     */
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 0; // Set status to 0 to mark as inactive
            $user->save(); // Save the change
        }

        session()->flash('message', __('Patient successfully deactivated.'));
    }
}
