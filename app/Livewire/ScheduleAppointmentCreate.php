<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleAppointmentCreate extends ScheduleAppointment
{
    public function mount($appointmentId = null)
    {
        $this->patient = Auth::user();
        $this->specialties = Specialty::pluck('name', 'id_specialty');
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
            /*session()->now('flash.banner', __('You have already scheduled two appointments for this day.'));
            session()->now('flash.bannerStyle', 'warning');*/
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

    public function render()
    {
        return view('livewire.schedule-appointment-create')->layout('layouts.app');
    }
}
