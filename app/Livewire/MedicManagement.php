<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Day;
use App\Models\Schedule;
use App\Models\State;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use App\Models\MedicSchedule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class MedicManagement extends Component
{
    use WithPagination;

    public $medic, $profile, $email, $password, $roles, $id_specialties, $specialties, $searchSpecialties, $selectedSpecialties = [], $searchStatuses, $selectedStatus, $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';
    public $countries;
    public $states = [];
    public $cities = [];
    //public $days = [];
    //public $medicSpecialties = [];
    //public $medicSchedules = [];

    public function mount()
    {
        $this->searchSpecialties = Specialty::pluck('name', 'id_specialty');
        $this->specialties = Specialty::where('status', 1)->get();
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

        $medics = User::with('profile')//$medics = User::with('profile', 'medicSchedules.schedule')
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
    }

    public function create()
    {
        $this->resetInputFields();
        $this->roles = Role::where('name', 'medic')->get();
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
            'password' => bcrypt($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);

        $user->assignRole('medic');

        $user->specialties()->sync($this->id_specialties);

        session()->flash('message',
            $this->id ? __('Medic successfully updated.') : __('Medic successfully created.'));

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $medic = User::with('profile', 'roles', 'specialties')->findOrFail($id);
        /*$medic = User::with('profile', 'roles', 'specialties', 'medicSchedules.schedule', 'medicSchedules.schedule.day')->findOrFail($id);
        $this->medicSpecialties = $medic->specialties->pluck('id_specialty')->toArray();
        $dayIds = Schedule::select('day_id')->distinct()->pluck('day_id');
        $this->days = Day::whereIn('id', $dayIds)->orderBy('id')->pluck('name', 'id')->toArray();
        $this->medicSchedules = $medic->medicSchedules;*/
        //dd($this->medicSchedules);


        $this->id = $id;
        $this->profile = $medic->profile->toArray();
        $this->email = $medic->email;
        $this->roles = Role::where('name', 'medic')->get();
        $this->id_specialties = $medic->specialties()->pluck('specialty.id_specialty')->toArray();
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

        session()->flash('message', __('Medic successfully deactivated.'));
    }
}
