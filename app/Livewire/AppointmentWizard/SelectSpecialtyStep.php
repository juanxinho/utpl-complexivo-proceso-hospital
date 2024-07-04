<?php

namespace App\Livewire\AppointmentWizard;

use Livewire\Component;
use App\Models\Specialty;

class SelectSpecialtyStep extends Component
{
    public $id_specialty;

    public function render()
    {
        return view('livewire.appointment-wizard.select-specialty-step', ['specialties' => Specialty::all()]);
    }

    public function nextStep()
    {
        $this->validate([
            'id_specialty' => 'required|exists:specialties,id',
        ]);

        $this->dispatch('goToNextStep', ['id_specialty' => $this->id_specialty]);
    }
}
