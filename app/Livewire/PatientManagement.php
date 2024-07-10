<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use App\Models\User;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class PatientManagement extends Component
{
    use WithPagination;

    public $patient, $profile, $email, $password, $searchStatuses, $selectedStatus, $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';
    public $countries;
    public $states = [];
    public $cities = [];

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
    public function updatedprofileCountryId()
    {
        $this->profile['state_id'] = null;
        $this->cities = [];
        $this->profile['city_id'] = null;
        $this->states = [];
        $this->loadStates();

    }
    public function updatedprofileStateId()
    {
        $this->profile['city_id'] = null;
        $this->cities = [];
        $this->loadCities();
    }

    protected function loadStates()
    {
        $this->states = State::where('country_id', $this->profile['country_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }

    protected function loadCities()
    {
        $this->cities = City::where('state_id', $this->profile['state_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }
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

    public function updatedSelectedStatus() {
        $this->render();
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

    public function create()
    {
        $this->resetInputFields();
        $this->isOpenCreate = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->id,
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
            'password' => bcrypt($this->password),
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

    public function edit($id)
    {
        $patient = User::with('profile')->findOrFail($id);

        $this->id = $id;
        $this->profile = $patient->profile->toArray();
        $this->email = $patient->email;
        //$this->password = $user->password;
        // Load states and cities for the selected country and state
        $this->loadStates();
        $this->loadCities();
        $this->isOpenEdit = true;
    }

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
