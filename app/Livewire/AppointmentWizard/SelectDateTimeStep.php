<?php

namespace App\Livewire\AppointmentWizard;

use Livewire\Component;
use Carbon\Carbon;

class SelectDateTimeStep extends Component
{
    public $appointment_date, $appointment_time;

    public function render()
    {
        return view('livewire.appointment-wizard.select-date-time-step');
    }

    public function nextStep()
    {
        $this->validate([
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
        ]);

        $this->dispatch('goToNextStep', ['appointment_date' => $this->appointment_date, 'appointment_time' => $this->appointment_time]);
    }
}

