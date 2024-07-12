<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Diagnostic;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Stock;
use App\Models\MedicalExam;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AttendPatient extends Component
{
    public $patient;
    public $diagnosis;
    public $labTests = [];
    public $imagingTests = [];
    public $prescriptionItems = [];
    public $nextControlDate;
    public $appointmentId;

    public function mount($appointmentId)
    {
        $this->appointmentId = $appointmentId;
        $appointment = Appointment::with('user.profile')->findOrFail($appointmentId);
        $this->patient = $appointment->user;
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
        $this->validate([
            'diagnosis' => 'required|string|max:255',
            'prescriptionItems.*.stock_id' => 'required|exists:stocks,id',
            'prescriptionItems.*.quantity' => 'required|integer|min:1',
            'nextControlDate' => 'nullable|date',
        ]);

        // Guardar el diagnóstico
        Diagnostic::create([
            'id_clinical_history' => $this->patient->profile->id_clinical_history,
            'description' => $this->diagnosis,
            'user_register' => Auth::id(),
            'date' => now(),
        ]);

        // Guardar la receta médica
        $prescription = Prescription::create([
            'patient_id' => $this->patient->id,
            'doctor_id' => Auth::id(),
            'notes' => $this->diagnosis,
        ]);

        foreach ($this->prescriptionItems as $item) {
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'stock_id' => $item['stock_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Solicitar exámenes de laboratorio e imagen
        foreach ($this->labTests as $test) {
            MedicalExam::create([
                'appointment_id' => $this->appointmentId,
                'type' => 'lab',
                'name' => $test,
            ]);
        }

        foreach ($this->imagingTests as $test) {
            MedicalExam::create([
                'appointment_id' => $this->appointmentId,
                'type' => 'imaging',
                'name' => $test,
            ]);
        }

        // Actualizar la fecha de próximo control
        if ($this->nextControlDate) {
            $appointment->next_control_date = $this->nextControlDate;
            $appointment->save();
        }

        session()->flash('message', 'Patient attended successfully!');
        return redirect()->route('medic.appointments');
    }

    public function render()
    {
        return view('livewire.attend-patient', [
            'stocks' => Stock::all(),
        ]);
    }
}

