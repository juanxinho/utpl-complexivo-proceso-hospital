<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class PatientHistory extends Component
{
    public $patient;

    public function mount($id)
    {
        $this->loadPatientHistory($id);
    }

    public function loadPatientHistory($id)
    {
        $this->patient = User::with([
            'profile',
            'appointments.medicSchedule.specialty',
            'appointments.medicalDiagnostics.diagnostics',
            'appointments.medicalDiagnostics.medicalTests',
            'appointments.prescriptions.items.stock'
        ])->findOrFail($id);
    }

    public function render()
    {
        return view('front.medic.appointments.patient-history', [
            'patient' => $this->patient
        ])->layout('layouts.app');
    }
}
