<?php

namespace App\Livewire;

use Livewire\Component;

class PatientInformationStep extends Component
{
    public $first_name, $last_name, $email, $phone;

    public function render()
    {
        return view('livewire.patient-information-step');
    }

    public function nextStep()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $this->emit('goToNextStep', ['first_name' => $this->first_name, 'last_name' => $this->last_name, 'email' => $this->email, 'phone' => $this->phone]);
    }
}

