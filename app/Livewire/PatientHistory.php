<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Appointment;
use Livewire\Component;

class PatientHistory extends Component
{
    public $patient;
    public $appointments;

    public function mount($id)
    {
        $this->loadPatientHistory($id);
    }

    public function loadPatientHistory($id)
    {
        $this->patient = User::findOrFail($id);
        $this->appointments = Appointment::where('id_patient', $id)
                                    ->whereIn('status', ['attended'])
                                    ->where('service_date', '<=', now()->format('Y-m-d'))
                                    ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                                    ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                                    ->select('appointment.*', 'schedule.time_range')
                                    ->orderBy('service_date', 'desc')
                                    ->orderBy('schedule.time_range', 'asc')
                                    ->get();    
    }

    public function render()
    {
        return view('front.medic.appointments.patient-history', [
            'patient' => $this->patient,
            'appointments' => $this->appointments
        ])->layout('layouts.app');
    }
}
