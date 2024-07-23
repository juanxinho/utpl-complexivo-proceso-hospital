<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicSchedule;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Day;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleAppointment extends Component
{
    public $patient;
    public $specialty_id;
    public $medic_id;
    public $date;
    public $time;
    public $today;
    public $maxDate;
    public $reason;
    public $appointmentId;
    public $specialties = [];
    public $medics = [];
    public $times = [];
    public $days = [];

    public $searchPatient = '';
    public $selectedPatient = null;
    public $patients = [];

    public function mount($appointmentId = null)
    {
        $this->specialties = Specialty::all()->pluck('name', 'id_specialty');
        $this->days = Day::orderBy('id')->pluck('name', 'id')->toArray();
    }

    public function resetInputFields()
    {
        $this->specialty_id = '';
        $this->medic_id = '';
        $this->date = '';
        $this->time = '';
        $this->reason = '';
        $this->medics = [];
        $this->times = [];
    }

    public function updatedSpecialtyId($value)
    {
        $this->validate([
            'specialty_id' => 'required|exists:specialty,id_specialty',
        ]);

        $query = User::role('medic')
            ->whereHas('specialties', function ($query) use ($value) {
                $query->where('specialty.id_specialty', $value);
            })
            ->join('profile', 'users.id_profile', '=', 'profile.id_profile')
            ->join('specialty_user', 'specialty_user.id_user', '=', 'users.id')
            ->join('specialty', 'specialty_user.id_specialty', '=', 'specialty.id_specialty')
            ->selectRaw('users.id, CONCAT(profile.first_name, " ", profile.last_name) as name');

        $this->medics = $query->pluck('name', 'users.id');
    }

    public function updatedMedicId($value)
    {
        $this->loadAvailableTimes();
    }

    public function updatedDate($value)
    {
        $this->loadAvailableTimes();
    }

    protected function loadAvailableTimes($selectedTimeId = null)
    {
        $this->validate([
            'specialty_id' => 'required|exists:specialty,id_specialty',
            'medic_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        if (!$this->date) {
            return;
        }

        $dayOfWeek = Carbon::parse($this->date)->dayOfWeekIso;
        $currentTime = Carbon::now()->format('H:i');

        $query = MedicSchedule::where('id_medic', $this->medic_id)
            ->whereHas('schedule', function ($query) use ($dayOfWeek) {
                $query->where('day_id', $dayOfWeek)
                    ->where('id_specialty', $this->specialty_id);
            })
            ->where(function ($query) use ($selectedTimeId) {
                $query->whereDoesntHave('appointments', function ($query) {
                    $query->where('service_date', $this->date)
                        ->where('status', 'scheduled');
                });

                if ($selectedTimeId) {
                    $query->orWhere('id_medic_schedule', $selectedTimeId);
                }
            })
            ->whereDoesntHave('appointments', function ($query) {
                $query->where('appointment.medic_schedule_id_medic_schedule', '!=', 'medic_shedule.id_medic_schedule')
                    ->where('appointment.status', '=', 'scheduled')
                    ->where('appointment.service_date', '=', $this->date);
            });

        // Filter out times that end before the current time if the selected date is today
        if ($this->date === Carbon::today()->toDateString()) {
            $query->whereHas('schedule', function ($query) use ($currentTime) {
                $query->whereRaw("SUBSTRING_INDEX(time_range, ' - ', -1) > ?", [$currentTime]);
            });
        }

        $schedules = $query->get();
        $availableTimes = [];
        foreach ($schedules as $schedule) {
            $availableTimes[$schedule->id_medic_schedule] = $schedule->schedule->time_range;
        }
        $this->times = $availableTimes;
    }


    public function updatedSearchPatient()
    {
        $this->patients = User::role('patient')
            ->join('profile', 'users.id', '=', 'profile.id_profile')
            ->where(function ($query) {
                $query->where('profile.first_name', 'like', '%' . $this->searchPatient . '%')
                    ->orWhere('profile.last_name', 'like', '%' . $this->searchPatient . '%')
                    ->orWhere('profile.nid', 'like', '%' . $this->searchPatient . '%')
                    ->orWhere('users.email', 'like', '%' . $this->searchPatient . '%');
            })
            ->select('users.*', 'profile.first_name', 'profile.last_name', 'profile.nid')
            ->take(5)
            ->get();
    }

    public function selectPatient($patientId)
    {
        $this->selectedPatient = User::with('profile')->find($patientId);
        $this->searchPatient = '';
        $this->patients = [];
        $this->patient = $this->selectedPatient;
    }

    public function removePatient()
    {
        $this->selectedPatient = null;
    }

    public function edit($id)
    {
        // To be overridden by derived classes
    }

    public function render()
    {
        // To be overridden by derived classes
    }
}
