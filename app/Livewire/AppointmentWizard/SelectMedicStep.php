<?php

namespace App\Livewire\AppointmentWizard;

use Livewire\Component;
use App\Models\User;

class SelectMedicStep extends Component
{
    public $doctor_id;

    public function render()
    {
        return view('livewire.appointment-wizard.select-medic-step', ['doctors' => User::role('medic')->get()]);
    }

    public function nextStep()
    {
        $this->validate([
            'doctor_id' => 'required|exists:users,id',
        ]);

        $this->dispatch('goToNextStep', ['doctor_id' => $this->doctor_id]);
    }
}

