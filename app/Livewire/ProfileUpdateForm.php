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

    /**
     * Initialize the component with user data, countries, states, and cities.
     *
     * This function is called when the component is mounted and initializes
     * the state with user data, and loads the list of countries. If the state
     * has a country_id and state_id, it loads the corresponding states and cities.
     *
     * @return void
     */
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

    /**
     * Update the states when the country changes.
     *
     * This function is called when the country ID is updated in the state
     * and it loads the corresponding states.
     *
     * @return void
     */
    public function updatedstateCountryId()
    {
        $this->state['state_id'] = null;
        $this->cities = [];
        $this->state['city_id'] = null;
        $this->states = [];
        $this->loadStates();
    }

    /**
     * Update the cities when the state changes.
     *
     * This function is called when the state ID is updated in the state
     * and it loads the corresponding cities.
     *
     * @return void
     */
    public function updatedstateStateId()
    {
        $this->state['city_id'] = null;
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
        $this->states = State::where('country_id', $this->state['country_id'])
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
        $this->cities = City::where('state_id', $this->state['state_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            });
    }

    /**
     * Update the user's profile information.
     *
     * This function validates the state data and updates the user's profile information
     * using the specified updater. It also updates the user's profile model.
     *
     * @param UpdatesUserProfileInformation $updater
     * @return void
     */
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

    /**
     * Update the user's verified profile information.
     *
     * This function updates the verified user's profile information
     * using the specified updater. It also updates the user's profile model.
     *
     * @param UpdateUserProfileInformation $updater
     * @return void
     */
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

    /**
     * Render the component view.
     *
     * This function retrieves the authenticated user and returns the view with the user data.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile-update-form');
    }
}
