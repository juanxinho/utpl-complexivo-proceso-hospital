<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Stock;
use App\Models\MedicalDiagnostic;
use App\Models\Diagnostics;
use App\Models\MedicalTest;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use Illuminate\Support\Facades\Auth;

class AttendPatient extends Component
{
    public $appointment;
    public $patient;
    public $diagnostics = [];
    public $diagnosticIds = [];
    public $medicalTests = [];
    public $medicalTestIds = [];
    public $recommendations;
    public $prescriptionItems = [];
    public $nextControlDate;

    protected $rules = [
        'diagnosticIds' => 'required|array|min:1',
        'recommendations' => 'nullable|string',
        'prescriptionItems' => 'required|array|min:1',
    ];

    public function mount($appointmentId)
    {
        $this->appointment = Appointment::with('user.profile', 'medicalDiagnostics.diagnostics', 'medicalDiagnostics.medicalTests')->findOrFail($appointmentId);
        $this->patient = $this->appointment->user;
    }

    public function addDiagnostic()
    {
        $this->diagnostics[] = ['id' => '', 'description' => ''];
    }

    public function removeDiagnostic($index)
    {
        unset($this->diagnostics[$index]);
        $this->diagnostics = array_values($this->diagnostics);
    }

    public function addMedicalTest()
    {
        $this->medicalTests[] = ['id' => '', 'name' => ''];
    }

    public function removeMedicalTest($index)
    {
        unset($this->medicalTests[$index]);
        $this->medicalTests = array_values($this->medicalTests);
    }

    public function addPrescriptionItem()
    {
        $this->prescriptionItems[] = ['stock_id' => '', 'quantity' => 1];
    }

    public function removePrescriptionItem($index)
    {
        unset($this->prescriptionItems[$index]);
        $this->prescriptionItems = array_values($this->prescriptionItems);
    }

    public function save()
    {
        $this->validate();
        $clinicalHistory = $this->appointment->user->clinicalHistory;

        if (!$clinicalHistory) {
            $clinicalHistory = $this->appointment->user->clinicalHistory()->create([
                'user_register' => Auth::id(),
            ]);
        }


        // Guardar el diagnóstico
        $medicalDiagnostic = MedicalDiagnostic::create([
            'id_clinical_history' => $clinicalHistory->id_clinical_history,
            'appointment_id' => $this->appointment->id_appointment,
            'recommendations' => $this->recommendations,
            'user_register' => Auth::id(),
            'date' => now(),
        ]);

        $prescription = Prescription::create([
            'date' => now(),
            'patient_id' => $this->patient->id,
            'appointment_id' => $this->appointment->id_appointment,
            'doctor_id' => Auth::id(),
        ]);

        foreach ($this->prescriptionItems as $item) {
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'stock_item_id' => $item['stock_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Actualizar la fecha de próximo control y estado
        if ($this->nextControlDate) {
            $this->appointment->next_control_date = $this->nextControlDate;
        }
        $this->appointment->status = 'attended';
        $this->appointment->save();

        $medicalDiagnostic->diagnostics()->attach(array_unique($this->diagnosticIds));
        $medicalDiagnostic->medicalTests()->attach(array_unique($this->medicalTestIds));

        session()->flash('flash.banner', __('Patient attended successfully.'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('medic.appointments.index');
    }

    public function render()
    {
        return view('front.medic.appointments.attend-patient', [
            'availableDiagnostics' => Diagnostics::all(),
            'availableMedicalTests' => MedicalTest::all(),
            'stocks' => Stock::all(),
        ])->layout('layouts.app');
    }
}

