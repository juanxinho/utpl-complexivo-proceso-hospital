<?php

namespace App\Livewire\AppointmentWizard;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PatientInformationStep extends Component
{
    public $selectedUserId;

    public function render()
    {
        $currentUser = Auth::user();
        if ($currentUser->hasRole('admin')) {
            $users = User::role('patient')->get();
        } else if ($currentUser->hasRole('patient')) {
            $users = User::where('id', $currentUser->id)->get();
        } else {
            $users = collect(); // Empty collection
        }

        return view('livewire.appointment-wizard.patient-information-step', compact('users'));
    }

    public function validateAndProceed()
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
        ]);

        $user = User::find($this->selectedUserId);

        $this->dispatch('goToNextStep', [
            'first_name' => $user->profile->first_name,
            'last_name' => $user->profile->last_name,
            'email' => $user->email,
            'phone' => $user->profile->phone,
        ]);
    }
}

