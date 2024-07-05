<?php

namespace App\Livewire;

use App\Models\MedicSchedule;
use Livewire\Component;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;

class ScheduleAppointment extends Component
{
    public $patient;
    public $specialty_id;
    public $medic_id;
    public $date;
    public $time;
    public $specialties = [];
    public $medics = [];
    public $times = [];

    public function mount()
    {
        $this->patient = Auth::user();
        $this->specialties = Specialty::pluck('name', 'id_specialty');
    }

    public function updatedSpecialtyId($value)
    {
        $query = User::role('medic')
            ->whereHas('specialties', function($query) use ($value) {
                $query->where('specialty.id_specialty', $value);
            })
            ->join('profile', 'users.id_profile', '=', 'profile.id_profile')
            ->join('specialty_user', 'specialty_user.id_user', '=', 'users.id')
            ->join('specialty', 'specialty_user.id_specialty', '=', 'specialty.id_specialty')
            ->selectRaw('users.id, CONCAT(profile.first_name, " ", profile.last_name) as name');

        // Dump the raw SQL query
        //dd($query->toSql(), $query->getBindings());

        // Execute the query and pluck results
        $this->medics = $query->pluck('name', 'users.id');
    }

    public function updatedMedicId($value)
    {
        $this->times = MedicSchedule::where('id_medic', $value)->get();
    }

    public function render()
    {
        return view('livewire.schedule-appointment') ->layout('layouts.app');
    }

    public function schedule()
    {
        $this->validate([
            'specialty_id' => 'required',
            'medic_id' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Logic to save the appointment

        session()->flash('message', 'Appointment scheduled successfully!');
    }
}



