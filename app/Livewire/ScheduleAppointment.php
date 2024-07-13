<?php

namespace App\Livewire;

use App\Models\MedicSchedule;
use Livewire\Component;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleAppointment extends Component
{
    public $patient;
    public $specialty_id;
    public $medic_id;
    public $date;
    public $time;
    public $reason;
    public $specialties = [];
    public $medics = [];
    public $times = [];

    public $searchPatient = '';
    public $selectedPatient = null;
    public $patients = [];

    public function mount()
    {
        $this->patient = Auth::user();
        $this->specialties = Specialty::pluck('name', 'id_specialty');
    }

    private function resetInputFields()
    {
        $this->specialty_id = '';
        $this->medic_id = '';
        $this->date= '';
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
        $this->loadAvailableTimes();
    }

    public function updatedDate($value)
    {
        $this->loadAvailableTimes();
    }

    protected function loadAvailableTimes()
    {
        $this->validate([
            'specialty_id' => 'required|exists:specialty,id_specialty',
            'medic_id' => 'required|exists:users,id',
        ]);

        $dayOfWeek = Carbon::parse($this->date)->format('l');


        $query = MedicSchedule::where('id_medic', $this->medic_id)
            ->whereHas('schedule', function ($query) use ($dayOfWeek) {
                $query->where('days', 'like', '%' . $dayOfWeek . '%')
                    ->where('id_specialty', $this->specialty_id);
            })
            ->whereDoesntHave('appointments', function ($query) {
                $query->where('appointment.medic_schedule_id_medic_schedule', '!=', 'medic_shedule.id_medic_schedule')
                      ->where('appointment.status', '=', 'scheduled')
                      ->where('appointment.service_date', '=', $this->date);
            });

        // Get the raw SQL query
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        // Debug: Dump the SQL and bindings
        //dd($sql, $bindings);

        $schedules = $query->get();
        $availableTimes = [];
        foreach ($schedules as $schedule) {
            $availableTimes[$schedule->id_medic_schedule] = $schedule->schedule->time_range;
        }
        $this->times = $availableTimes;
    }

    public function render()
    {
        return view('livewire.schedule-appointment')->layout('layouts.app');
    }

    public function editadmin($id)
    {
        $appointment = Appointment::find($id);
        $patient = $appointment->user;
        $specialties = Specialty::pluck('name', 'id_specialty');
        $this->specialty_id = $appointment->medicSchedule->specialty->id_specialty; 
        $this->medic_id = $appointment->medicSchedule->user->id;
        $this->date = $appointment->service_date;
        $this->time = $appointment->medic_schedule_id_medic_schedule;

        $this->updatedSpecialtyId($this->specialty_id);
        $this->updatedMedicId($this->medic_id);
        $this->updatedDate($this->date);

        $medics = $this->medics;
        $times = $this->times;

        return view('livewire.schedule-appointment-edit', compact('patient','specialties','medics','times'))->layout('layouts.app');
    }

    public function schedule()
    {
        $this->validate([
            'specialty_id' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $appointmentCount = Appointment::where('id_patient', $this->patient->id)
            ->whereDate('service_date', Carbon::parse($this->date))
            ->count();

        if ($appointmentCount >= 2) {
            session()->flash('message', 'You have already scheduled two appointments for this day.');
            return;
        }

        // Logic to save the appointment
        Appointment::create([
            'id_patient' => $this->patient->id,
            'user_register' => $this->patient->id,
            'record_date' => now(),
            'medic_schedule_id_medic_schedule' => $this->time,//id de schedule_medic
            'service_date' => Carbon::parse($this->date),//fecha de la cita
            'reason' => $this->reason,
            'status' => 'scheduled',
        ]);

        session()->flash('message', 'Appointment scheduled successfully!');
        $this->resetInputFields();
    }

    public function updatedsearchPatient()
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
    }

    public function removePatient()
    {
        $this->selectedPatient = null;
    }
}



