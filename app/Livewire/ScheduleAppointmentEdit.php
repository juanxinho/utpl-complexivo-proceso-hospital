<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;

class ScheduleAppointmentEdit extends ScheduleAppointment
{
    /**
     * Initialize the component with default values and load the appointment details for editing.
     *
     * This function is called when the component is mounted.
     *
     * @param int|null $appointmentId The ID of the appointment to be edited.
     * @return void
     */
    public function mount($appointmentId = null)
    {
        $this->edit($appointmentId);
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
     * Load medics based on the selected specialty without resetting dependent fields.
     *
     * @param int $value The ID of the selected specialty.
     * @return void
     */
    public function loadSpecialtyId($value)
    {
        parent::updatedSpecialtyId($value);
    }

    /**
     * Load available dates based on the selected medic without resetting dependent fields.
     *
     * @param int $value The ID of the selected medic.
     * @return void
     */
    public function loadMedicId($value)
    {
        parent::updatedMedicId($value);
    }

    /**
     * Load available times based on the selected date without resetting dependent fields.
     *
     * @param string $value The selected date.
     * @return void
     */
    public function loadDate($value)
    {
        parent::updatedDate($value);
    }

    /**
     * Load the details of the appointment to be edited.
     *
     * This function loads the appointment details and sets the component's state for editing.
     *
     * @param int $id The ID of the appointment to be edited.
     * @return void
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $this->patient = User::with('profile')->find($appointment->user->id);
        $this->specialties = Specialty::pluck('name', 'id_specialty');

        $this->specialty_id = $appointment->medicSchedule->specialty->id_specialty;
        $this->medic_id = $appointment->medicSchedule->id_medic;
        $this->date = $appointment->service_date;
        $this->time = $appointment->medic_schedule_id_medic_schedule;
        $this->reason = $appointment->reason;
        $this->today = Carbon::today()->toDateString();

        $this->loadSpecialtyId($this->specialty_id);
        $this->loadMedicId($this->medic_id);
        $this->loadDate($this->date);
        $this->loadAvailableTimes($this->time);
    }

    /**
     * Reschedule the appointment with the updated details.
     *
     * This function validates the input data and updates the appointment details.
     * It ensures that the patient does not exceed the limit of two appointments per day.
     *
     * @return void
     */
    public function reschedule()
    {
        $this->validate([
            'specialty_id' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $appointmentCount = Appointment::where('id_patient', $this->patient->id)
            ->whereDate('service_date', Carbon::parse($this->date))
            ->count();

        if ($appointmentCount > 2) {
            session()->flash('message', __('You have already scheduled two appointments for this day.'));
            return;
        }

        // Logic to save the appointment
        $appointment = Appointment::find($this->appointmentId);
        $appointment->update([
            'user_register' => $this->patient->id,
            'modification_date' => now(),
            'medic_schedule_id_medic_schedule' => $this->time,
            'service_date' => Carbon::parse($this->date),
            'reason' => $this->reason,
            'status' => 'scheduled',
        ]);

        session()->flash('flash.banner', __('Appointment rescheduled successfully!'));
        session()->flash('flash.bannerStyle', 'success');

        $this->resetInputFields();
        return redirect()->route('admin.appointments.index');
    }

    /**
     * Render the component view.
     *
     * This function returns the view for editing an appointment.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        return view('livewire.schedule-appointment-edit')->layout('layouts.app');
    }
}
