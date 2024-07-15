<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Schedule;
use App\Models\MedicSchedule;

class MedicSpecialtySchedule extends Component
{
    public $medics;
    public $selectedMedic = null;
    public $specialties = [];
    public $schedules = [];
    public $selectedSpecialty = null;
    public $selectedSchedules = [];
    public $medicSpecialties = [];
    public $specialtyDays = [];
    public $specialtySchedules = [];

    public function mount()
    {
        $this->medics = User::role('medic')->with('specialties', 'medicSchedules.schedule')->get();
        $this->specialties = Specialty::all();
        $this->schedules = Schedule::all();
    }

    public function updatedSelectedMedic($medicId)
    {
        $medic = User::with('specialties', 'medicSchedules.schedule')->find($medicId);
        $this->medicSpecialties = $medic->specialties->pluck('id_specialty')->toArray();
    }

    public function assignSpecialty()
    {
        $medic = User::find($this->selectedMedic);
        $medic->specialties()->sync($this->medicSpecialties);
        session()->flash('message', 'Specialties assigned successfully.');
    }

    public function assignSchedule($specialtyId)
    {
        foreach ($this->specialtyDays[$specialtyId] as $day) {
            $scheduleIds = $this->specialtySchedules[$specialtyId][$day] ?? [];
            foreach ($scheduleIds as $scheduleId) {
                MedicSchedule::create([
                    'id_medic' => $this->selectedMedic,
                    'id_specialty' => $specialtyId,
                    'id_schedule' => $scheduleId,
                    'day' => $day,
                ]);
            }
        }
        session()->flash('message', 'Schedules assigned successfully.');
    }

    public function render()
    {
        return view('livewire.medic-specialty-schedule')->layout('layouts.app');
    }
}
