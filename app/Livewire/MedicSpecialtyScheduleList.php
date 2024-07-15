<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Schedule;

class MedicSpecialtyScheduleList extends Component
{
    public $medics = [];
    public $days = [];

    public function mount()
    {
        $medics = User::role('medic')->with('profile', 'specialties', 'medicSchedules.schedule')->get();
        $this->days = Schedule::select('days')->distinct()->pluck('days');

        foreach ($medics as $medic) {
            $medicName = $medic->profile->first_name . ' ' . $medic->profile->last_name;

            foreach ($medic->specialties as $specialty) {
                foreach ($medic->medicSchedules as $medicSchedule) {
                    if ($medicSchedule->id_specialty == $specialty->id_specialty) {
                        $day = $medicSchedule->schedule->days;
                        $specialtyName = $specialty->name;
                        $timeRange = $medicSchedule->schedule->time_range;

                        $this->medics[$medicName][$specialtyName][$day][] = $timeRange;
                    }
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.medic-specialty-schedule-list')->layout('layouts.app');
    }
}
