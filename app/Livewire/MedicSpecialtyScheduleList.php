<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Day;
use App\Models\Schedule;

class MedicSpecialtyScheduleList extends Component
{
    public $medics = [];
    public $days = [];

    public function mount()
    {
        $medics = User::role('medic')->with('profile', 'specialties', 'medicSchedules.schedule.day')->get();

        // Get the distinct day ids from the schedule table
        $dayIds = Schedule::select('day_id')->distinct()->pluck('day_id');
        $this->days = Day::whereIn('id', $dayIds)->orderBy('id')->pluck('name', 'id')->toArray();


        foreach ($medics as $medic) {
            $medicName = $medic->profile->first_name . ' ' . $medic->profile->last_name;

            foreach ($medic->specialties as $specialty) {
                foreach ($medic->medicSchedules as $medicSchedule) {
                    if ($medicSchedule->id_specialty == $specialty->id_specialty) {
                        if ($medicSchedule->schedule && $medicSchedule->schedule->day) {
                            $dayName = $medicSchedule->schedule->day->name;
                            $specialtyName = $specialty->name;
                            $timeRange = $medicSchedule->schedule->time_range;

                            $this->medics[$medicName][$specialtyName][$dayName][] = $timeRange;
                        }
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
