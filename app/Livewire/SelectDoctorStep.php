<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class SelectDoctorStep extends Component
{
    public $doctor_id;

    public function render()
    {
        return view('livewire.select-doctor-step', ['doctors' => User::role('medic')->get()]);
    }

    public function nextStep()
    {
        $this->validate([
            'doctor_id' => 'required|exists:users,id',
        ]);

        $this->emit('goToNextStep', ['doctor_id' => $this->doctor_id]);
    }
}

