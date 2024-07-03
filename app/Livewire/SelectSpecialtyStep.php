<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Specialty;

class SelectSpecialtyStep extends Component
{
    public $specialty_id;

    public function render()
    {
        return view('livewire.select-specialty-step', ['specialties' => Specialty::all()]);
    }

    public function nextStep()
    {
        $this->validate([
            'specialty_id' => 'required|exists:specialties,id',
        ]);

        $this->emit('goToNextStep', ['specialty_id' => $this->specialty_id]);
    }
}
