<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Appointment;
use Livewire\Component;

class PatientHistory extends Component
{
    public $patient;
    public $appointments;

    /**
     * Initialize the component with patient data and appointments history.
     *
     * This function is called when the component is mounted and loads
     * the patient history for the given patient ID.
     *
     * @param int $id The ID of the patient.
     * @return void
     */
    public function mount($id)
    {
        $this->loadPatientHistory($id);
    }

    /**
     * Load the patient history.
     *
     * This function retrieves the patient details and their attended appointments
     * up to the current date, then stores them in the component's properties.
     *
     * @param int $id The ID of the patient.
     * @return void
     */
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

    /**
     * Render the component view.
     *
     * This function returns the view with the patient and appointments data.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        return view('front.medic.appointments.patient-history', [
            'patient' => $this->patient,
            'appointments' => $this->appointments
        ])->layout('layouts.app');
    }
}
