<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;

class ConfirmAppointmentStep extends Component
{
    public function render()
    {
        return view('livewire.confirm-appointment-step');
    }

    public function finish()
    {
        $appointment = Appointment::create([
            'patient_id' => auth()->user()->id,
            'specialty_id' => $this->state['specialty_id'],
            'doctor_id' => $this->state['doctor_id'],
            'appointment_date' => $this->state['appointment_date'],
            'appointment_time' => $this->state['appointment_time'],
        ]);

        $this->emit('appointmentScheduled', $appointment->id);
    }
}
