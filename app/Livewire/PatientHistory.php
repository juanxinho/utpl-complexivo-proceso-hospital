<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class PatientHistory extends Component
{
    public $patient;
    public $id;

    public function mount($id)
    {
        $this->id = $id;
        $this->loadPatientHistory();
    }

    public function loadPatientHistory()
    {
        $this->patient = User::with([
            'profile',
            'appointments' => function($query) {
                $query->where('id_patient', $this->id);
            },
            'appointments.medicSchedule.specialty',
            'appointments.medicalDiagnostics',
            'appointments.prescriptions.items'
        ])->findOrFail($this->id);    }

    public function render()
    {
        return view('front.medic.appointments.patient-history')->layout('layouts.app');
    }
}
