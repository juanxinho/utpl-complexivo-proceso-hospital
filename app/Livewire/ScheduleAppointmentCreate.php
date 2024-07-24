<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleAppointmentCreate extends ScheduleAppointment
{
    /**
     * Initialize the component with default values.
     *
     * This function is called when the component is mounted.
     * It sets the default values for the current date, maximum date, and patient information.
     *
     * @param int|null $appointmentId The ID of the appointment to be scheduled (optional).
     * @return void
     */
    public function mount($appointmentId = null)
    {
        $this->today = Carbon::today()->toDateString();
        $this->maxDate = Carbon::today()->addWeeks(2)->toDateString();
        $this->patient = Auth::user();
        $this->specialties = Specialty::pluck('name', 'id_specialty');
    }

    /**
     * Load medics based on the selected specialty and reset dependent fields.
     *
     * This function resets the medic, date, and time fields when the specialty is updated.
     * It then calls the parent class method to load the medics.
     *
     * @param int $value The ID of the selected specialty.
     * @return void
     */
    public function updatedSpecialtyId($value)
    {
        $this->medic_id = '';
        $this->date = '';
        $this->time = '';

        parent::updatedSpecialtyId($value);
    }

    /**
     * Load available dates based on the selected medic and reset dependent fields.
     *
     * This function resets the date and time fields when the medic is updated.
     * It then calls the parent class method to load the available dates.
     *
     * @param int $value The ID of the selected medic.
     * @return void
     */
    public function updatedMedicId($value)
    {
        $this->date = '';
        $this->time = '';

        parent::updatedMedicId($value);
    }

    /**
     * Load available times based on the selected date and reset dependent fields.
     *
     * This function resets the time field when the date is updated.
     * It then calls the parent class method to load the available times.
     *
     * @param string $value The selected date.
     * @return void
     */
    public function updatedDate($value)
    {
        $this->time = '';

        parent::updatedDate($value);
    }

    /**
     * Schedule an appointment for the patient.
     *
     * This function validates the input data and schedules a new appointment for the patient.
     * It ensures that the patient does not exceed the limit of two appointments per day.
     *
     * @return void
     */
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
            $this->dispatch('flashMessage', [
                'bannerStyle' => 'warning',
                'message' => __('You have already scheduled two appointments for this day.')
            ]);
            return;
        }

        // Logic to save the appointment
        Appointment::create([
            'id_patient' => $this->patient->id,
            'user_register' => $this->patient->id,
            'record_date' => now(),
            'medic_schedule_id_medic_schedule' => $this->time,
            'service_date' => Carbon::parse($this->date),
            'reason' => $this->reason,
            'status' => 'scheduled',
        ]);

        session()->flash('flash.banner', __('Appointment scheduled successfully!'));
        session()->flash('flash.bannerStyle', 'success');

        $this->resetInputFields();
        return redirect()->route('admin.appointments.index');
    }

    /**
     * Render the component view.
     *
     * This function returns the view for creating a new appointment.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        return view('livewire.schedule-appointment-create')->layout('layouts.app');
    }
}
