<?php

namespace App\Livewire;

use App\Models\MedicSchedule;
use App\Models\Specialty;
use Livewire\Component;
use App\Models\User;
use App\Models\Day;
use App\Models\Schedule;

class MedicSpecialtySchedule extends Component
{
    public $medics = [];
    public $days;
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
        //$this->medics = User::role('medic')->with('specialties', 'medicSchedules.schedule')->get();
        $this->specialties = Specialty::all();
        $this->schedules = Schedule::all();
        $this->days = Day::orderBy('id')->pluck('name', 'id')->toArray();
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
        foreach ($this->specialtyDays[$specialtyId] as $dayId) {
            $scheduleIds = $this->specialtySchedules[$specialtyId][$dayId] ?? [];
            foreach ($scheduleIds as $scheduleId) {
                MedicSchedule::create([
                    'id_medic' => $this->selectedMedic,
                    'id_specialty' => $specialtyId,
                    'id_schedule' => $scheduleId,
                ]);
            }
        }
        session()->flash('message', 'Schedules assigned successfully.');
    }

    public function render()
    {
        $medics = User::role('medic')
            ->with(['profile', 'specialties', 'medicSchedules.schedule.day'])
            ->get();

        // Get the distinct day ids from the schedule table
        $dayIds = Schedule::select('day_id')->distinct()->pluck('day_id');
        $this->days = Day::whereIn('id', $dayIds)->orderBy('id')->pluck('name', 'id')->toArray();

        foreach ($medics as $medic) {
            $medicName = $medic->profile->first_name . ' ' . $medic->profile->last_name;
            $specialtySchedules = [];

            foreach ($medic->specialties as $specialty) {
                $specialtyName = $specialty->name;
                $daySchedule = [];

                foreach ($medic->medicSchedules as $medicSchedule) {
                    if ($medicSchedule->id_specialty == $specialty->id_specialty) {
                        if ($medicSchedule->schedule && $medicSchedule->schedule->day) {
                            $dayName = $medicSchedule->schedule->day->name;
                            $timeRange = $medicSchedule->schedule->time_range;
                            $daySchedule[$dayName][] = $timeRange;
                        }
                    }
                }

                $specialtySchedules[$specialtyName] = $daySchedule;
            }

            $this->medics[$medicName] = $specialtySchedules;
        }

        return view('admin.medics.schedules.index')->layout('layouts.app');
    }
}
