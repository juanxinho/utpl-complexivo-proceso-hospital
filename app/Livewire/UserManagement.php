<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    use WithPagination;

    public $profile, $email, $password, $roles, $id_roles, $searchRoles, $selectedRole, $searchStatuses, $selectedStatus, $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';
    public $countries;
    public $states = [];
    public $cities = [];

    public function mount()
    {
        $this->searchRoles = Role::pluck('name', 'name');
        $this->searchStatuses = ['0' => 'Inactive', '1' => 'Active'];
        $this->roles = Role::all();
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

    public function updatedstateCountryId()
    {
        $this->profile['state_id'] = null;
        $this->cities = [];
        $this->profile['city_id'] = null;
        $this->states = [];
        $this->loadStates();

    }
    public function updatedstateStateId()
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

        $users = User::with('profile')
            ->when($this->selectedRole, function ($query) {
                $query->role($this->selectedRole);
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
            ->paginate(10);

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'))->layout('layouts.app');
    }

    public function updatedSelectedRole() {
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
        $this->selectedRole = '';
        $this->selectedStatus = null;
    }

    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    private function resetInputFields()
    {
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
        $this->id_roles = [];
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
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'id_roles' => 'required|array|min:1',
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
            'address' => $this->profile['address'],
            'user_register' => auth()->user()->id,
        ]);

        $user = User::updateOrCreate(['id' => $this->id], [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);


        $roles = Role::whereIn('id',  $this->id_roles)->get();
        $user->syncRoles($roles);


        session()->flash('message',
            $this->id ? __('User successfully updated.') : __('User successfully created.'));

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::with('profile', 'roles')->findOrFail($id);

        $this->id = $id;
        $this->profile = $user->profile->toArray();
        $this->email = $user->email;
        //$this->password = $user->password;
        $this->id_roles = $user->roles->pluck('id')->toArray();
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

        session()->flash('message', __('User successfully deactivated.'));
    }
}

