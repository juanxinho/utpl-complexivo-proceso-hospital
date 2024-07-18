<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProfileUpdateForm extends Component
{
    use WithFileUploads;

    public $state = [];
    public $countries;
    public $states = [];
    public $cities = [];

    public function mount()
    {
        $user = Auth::user();
        $this->state = array_merge($user->toArray(), $user->profile->toArray());
        $this->countries = Country::pluck('name', 'id')->map(function ($name) {
            return ucfirst($name);
        });

        if ($this->state['country_id']) {
            $this->loadStates();
        }

        if ($this->state['state_id']) {
            $this->loadCities();
        }
    }

    public function updatedstateCountryId()
    {
        $this->state['state_id'] = null;
        $this->cities = [];
        $this->state['city_id'] = null;
        $this->states = [];
        $this->loadStates();

    }
    public function updatedstateStateId()
    {
        $this->state['city_id'] = null;
        $this->cities = [];
        $this->loadCities();
    }

    protected function loadStates()
    {
        $this->states = State::where('country_id', $this->state['country_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }

    protected function loadCities()
    {
        $this->cities = City::where('state_id', $this->state['state_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }

    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $user = Auth::user();

        Validator::make($this->state, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'phone' => ['required', 'string', new EcuadorPhone],
            'gender' => ['required', 'string', 'in:M,F'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
        ])->validate();

        $updater->update($user, $this->state);

        $user->profile->update([
            'first_name' => $this->state['first_name'],
            'last_name' => $this->state['last_name'],
            'nid' => $this->state['nid'],
            'phone' => $this->state['phone'],
            'gender' => $this->state['gender'],
            'dob' => $this->state['dob'],
            'country_id' => $this->state['country_id'],
            'state_id' => $this->state['state_id'],
            'city_id' => $this->state['city_id'],
            'address' => $this->state['address'],
        ]);

        $this->dispatch('saved');
    }
    protected function updateVerifiedProfileInformation(UpdateUserProfileInformation $updater)
    {
        $user = Auth::user();

        $updater->updateVerifiedUser($user, $this->state);

        $user->profile->update([
            'first_name' => $this->state['first_name'],
            'last_name' => $this->state['last_name'],
            'nid' => $this->state['nid'],
            'phone' => $this->state['phone'],
            'gender' => $this->state['gender'],
            'dob' => $this->state['dob'],
            'country_id' => $this->state['country_id'],
            'state_id' => $this->state['state_id'],
            'city_id' => $this->state['city_id'],
            'address' => $this->state['address'],
        ]);

        $this->dispatch('saved');
    }

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile-update-form');
    }
}
