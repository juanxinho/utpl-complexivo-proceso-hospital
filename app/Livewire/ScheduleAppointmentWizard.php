<?php

namespace App\Livewire;

use Livewire\Component;

class ScheduleAppointmentWizard extends Component
{
    public $step = 1;
    public $state = [];

    protected $listeners = ['goToNextStep', 'appointmentScheduled'];

    public function render()
    {
        return view('livewire.schedule-appointment-wizard')->layout('layouts.app');
    }

    public function goToNextStep($data)
    {
        $this->state = array_merge($this->state, $data);
        $this->step++;
    }

    public function appointmentScheduled($appointmentId)
    {
        // Handle post-scheduling logic here
        return redirect()->route('patient.appointments.index')->with('success', 'Appointment scheduled successfully.');
    }
}

