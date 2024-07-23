<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;

class ScheduleAppointmentEdit extends ScheduleAppointment
{
    public function mount($appointmentId = null)
    {
        $this->edit($appointmentId);
    }

    public function updatedSpecialtyId($value)
    {
        $this->medic_id = '';
        $this->date = '';
        $this->time = '';

        parent::updatedSpecialtyId($value);
    }

    public function updatedMedicId($value)
    {
        $this->date = '';
        $this->time = '';

        parent::updatedMedicId($value);
    }

    public function updatedDate($value)
    {
        $this->time = '';

        parent::updatedDate($value);
    }

    public function loadSpecialtyId($value)
    {
        parent::updatedSpecialtyId($value);
    }

    public function loadMedicId($value)
    {
        parent::updatedMedicId($value);
    }

    public function loadDate($value)
    {
        parent::updatedDate($value);
    }
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

        $this->loadSpecialtyId($this->specialty_id);
        $this->loadMedicId($this->medic_id);
        $this->loadDate($this->date);
        $this->loadAvailableTimes($this->time);
    }

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

    public function render()
    {
        return view('livewire.schedule-appointment-edit')->layout('layouts.app');
    }
}
