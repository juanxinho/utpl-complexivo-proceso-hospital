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
    public $medic; 
    public $id_schedules = []; 
    public $specialty; 
    public $selectedMedic = null;
    public $specialties = [];
    public $id_other_schedules = [];
    public $schedules = [];
    public $selectedSpecialty = null;
    public $selectedSchedules = [];
    public $medicSpecialties = [];
    public $specialtyDays = [];
    public $specialtySchedules = [];
    public $timeRanges = [];
    public $isOpenCreate = false;
    public $isOpenEdit = false;

    public function mount()
    {
        $this->specialties = Specialty::all();
        $this->schedules = Schedule::all();
        $this->days = Day::orderBy('id')->pluck('name', 'id')->toArray();
    }

    private function resetInputFields()
    {
        $this->id_other_schedules = [];
        $this->id_schedules = [];
        $this->specialties = [];
        $this->schedules = [];
        $this->timeRanges = [];
        $this->medic = null;
        $this->specialty = null;
    }
      

    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    public function assignMedicSchedule()
    {
        //$this->validate();

        MedicSchedule::where('id_specialty', $this->specialty->id_specialty)
            ->where('id_medic', $this->medic->id)
            ->delete();
        

        foreach ($this->id_schedules as $id_schedule) {
            MedicSchedule::create([
                'id_specialty' => $this->specialty->id_specialty,
                'id_medic' => $this->medic->id,
                'id_schedule' => $id_schedule,
            ]);
        }

        session()->flash('message', 'Schedules updated successfully.');

        $this->resetInputFields();
        $this->closeModal();
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
                            $daySchedule[$dayName][$medicSchedule->id_medic_schedule] = $timeRange;
                        }
                    }
                }

                $specialtySchedules[$specialtyName] =
                [
                    'daySchedule' => $daySchedule,
                    'user_id' => $medic->id,
                    'specialty_id' => $specialty->id_specialty,
                ]; 
            }

            $this->medics[$medicName] = $specialtySchedules;
        }

        return view('admin.medics.schedules.index', compact('medics'))->layout('layouts.app');
    }

    public function edit($user_id, $specialty_id)
    {
        $this->medic = User::find($user_id);
        $this->specialty = Specialty::find($specialty_id);
        $this->loadSchedules();
        $this->loadOtherSchedules();
        $this->loadTimeRanges();
        $this->isOpenEdit = true;
    }

    public function loadSchedules()
    {
        $this->id_schedules = MedicSchedule::where('id_specialty', $this->specialty->id_specialty)
            ->where('id_medic', $this->medic->id)
            ->get()
            ->pluck('id_schedule')
            ->toArray();
    }

    public function loadOtherSchedules()
    {
        $this->id_other_schedules = MedicSchedule::where('id_medic', $this->medic->id)
            ->whereNotIn('id_specialty', [$this->specialty->id_specialty])
            ->get()
            ->pluck('id_schedule')
            ->toArray();
    }

    public function loadTimeRanges()
    {
        $this->timeRanges = Schedule::with('day')->get();
    }
}
