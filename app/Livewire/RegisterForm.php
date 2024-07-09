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

    public function updatedStateCountryId($value)
    {
        $this->state['state_id'] = null;
        $this->cities = [];
        $this->state['city_id'] = null;
        $this->states = [];
        $this->loadStates();
    }

    public function updatedStateStateId($value)
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
            })->toArray();
    }

    protected function loadCities()
    {
        $this->cities = City::where('state_id', $this->state['state_id'])
            ->pluck('name', 'id')
            ->map(function ($name) {
                return ucfirst($name);
            })->toArray();
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
