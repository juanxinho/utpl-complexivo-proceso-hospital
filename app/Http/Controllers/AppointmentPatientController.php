<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentPatientController extends Controller
{
    /**
    * Obtiene la vista de proximas citas paciente sin considerar 
    * las citas en estado atendidas y canceladas
    *
    * @return view front.patient.appointments.next
    */
    public function next()
    {
        $appointments = Appointment::where('id_patient', Auth::id())
                                    ->whereNotIn('status', ['attended','cancelled'])
                                    ->where('service_date', '>=', now()->format('Y-m-d'))
                                    ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                                    ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                                    ->select('appointment.*', 'schedule.time_range')
                                    ->orderBy('service_date', 'asc')
                                    ->orderBy('schedule.time_range', 'asc')
                                    ->get();       

        return view('front.patient.appointments.next', compact('appointments'));
    }

    /**
    * Obtiene la vista de historial citas paciente
    *
    * @return view front.patient.appointments.history
    */
    public function history()
    {
        $appointments = Appointment::where('id_patient', Auth::id())
                                    ->whereIn('status', ['attended','cancelled'])
                                    ->where('service_date', '<=', now()->format('Y-m-d'))
                                    ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                                    ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                                    ->select('appointment.*', 'schedule.time_range')
                                    ->orderBy('service_date', 'desc')
                                    ->orderBy('schedule.time_range', 'asc')
                                    ->get(); 

        return view('front.patient.appointments.history', compact('appointments'));
    }

}
