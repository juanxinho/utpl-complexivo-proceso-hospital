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

    /**
     * Initialize the component with default values.
     *
     * This function is called when the component is mounted.
     * It initializes the specialties and days arrays.
     *
     * @param int|null $appointmentId The ID of the appointment to be scheduled (optional).
     * @return void
     */
    public function mount($appointmentId = null)
    {
        $this->specialties = Specialty::all()->pluck('name', 'id_specialty');
        $this->days = Day::orderBy('id')->pluck('name', 'id')->toArray();
    }

    /**
     * Reset the input fields to their default values.
     *
     * This function clears all input fields for scheduling an appointment.
     *
     * @return void
     */
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

    /**
     * Load medics based on the selected specialty.
     *
     * This function retrieves medics for the selected specialty and updates the medics array.
     *
     * @param int $value The ID of the selected specialty.
     * @return void
     */
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

    /**
     * Load available times based on the selected medic.
     *
     * This function loads the available times for the selected medic.
     *
     * @param int $value The ID of the selected medic.
     * @return void
     */
    public function updatedMedicId($value)
    {
        $this->loadAvailableTimes();
    }

    /**
     * Load available times based on the selected date.
     *
     * This function loads the available times for the selected date.
     *
     * @param string $value The selected date.
     * @return void
     */
    public function updatedDate($value)
    {
        $this->loadAvailableTimes();
    }

    /**
     * Load available times for the selected medic and date.
     *
     * This function retrieves the available times for the selected medic and date.
     *
     * @param int|null $selectedTimeId The ID of the selected time (optional).
     * @return void
     */
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
                $query->where('appointment.medic_schedule_id_medic_schedule', '!=', 'medic_schedule.id_medic_schedule')
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

    /**
     * Load patients based on the search term.
     *
     * This function retrieves patients based on the search term and updates the patients array.
     *
     * @return void
     */
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

    /**
     * Select a patient for scheduling an appointment.
     *
     * This function selects a patient based on their ID and updates the patient details.
     *
     * @param int $patientId The ID of the selected patient.
     * @return void
     */
    public function selectPatient($patientId)
    {
        $this->selectedPatient = User::with('profile')->find($patientId);
        $this->searchPatient = '';
        $this->patients = [];
        $this->patient = $this->selectedPatient;
    }

    /**
     * Remove the selected patient.
     *
     * This function clears the selected patient details.
     *
     * @return void
     */
    public function removePatient()
    {
        $this->selectedPatient = null;
    }

    /**
     * Edit an existing appointment (to be overridden by derived classes).
     *
     * This function is intended to be overridden by derived classes to provide
     * the functionality for editing an existing appointment.
     *
     * @param int $id The ID of the appointment to be edited.
     * @return void
     */
    public function edit($id)
    {
        // To be overridden by derived classes
    }

    /**
     * Render the component view (to be overridden by derived classes).
     *
     * This function is intended to be overridden by derived classes to provide
     * the functionality for rendering the component view.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        // To be overridden by derived classes
    }
}

