<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class RegisterForm extends Component
{
    public $state = [];
    public $countries;
    public $states = [];
    public $cities = [];

    /**
     * Initialize the component with a list of countries, states, and cities.
     *
     * This function is called when the component is mounted and initializes
     * the list of countries. If the state has a country_id and state_id, it loads
     * the corresponding states and cities.
     *
     * @return void
     */
    public function mount()
    {
        $this->countries = Country::pluck('name', 'id')->map(function ($name) {
            return ucfirst($name);
        })->toArray();

        if (isset($this->state['country_id'])) {
            $this->loadStates();
        }

        if (isset($this->state['state_id'])) {
            $this->loadCities();
        }
    }

    /**
     * Update the states when the country changes.
     *
     * This function is called when the country ID is updated in the state
     * and it loads the corresponding states.
     *
     * @param mixed $value The new value of the country ID.
     * @return void
     */
    public function updatedStateCountryId($value)
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
     * @param mixed $value The new value of the state ID.
     * @return void
     */
    public function updatedStateStateId($value)
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
            })->toArray();
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
            })->toArray();
    }

    /**
     * Render the component view.
     *
     * This function returns the view for the component.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        return view('livewire.register-form');
    }
}
