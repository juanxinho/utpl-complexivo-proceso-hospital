<?php

namespace App\Livewire\AppointmentWizard;

use Livewire\Component;
use App\Models\Appointment;

class ConfirmAppointmentStep extends Component
{
    public function render()
    {
        return view('livewire.appointment-wizard.confirm-appointment-step');
    }

    public function finish()
    {
        $appointment = Appointment::create([
            'patient_id' => auth()->user()->id,
            'id_specialty' => $this->state['id_specialty'],
            'doctor_id' => $this->state['doctor_id'],
            'appointment_date' => $this->state['appointment_date'],
            'appointment_time' => $this->state['appointment_time'],
        ]);

        $this->dispatch('appointmentScheduled', $appointment->id);
    }
}
