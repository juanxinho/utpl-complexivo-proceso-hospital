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
     * Display the view for the patient's upcoming appointments.
     *
     * This function retrieves and displays a list of the patient's upcoming appointments,
     * excluding those with a status of 'attended' or 'cancelled'. The appointments are
     * ordered by the service date and time range in ascending order.
     *
     * @return \Illuminate\View\View The view displaying the list of upcoming appointments.
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
     * Display the view for the patient's appointment history.
     *
     * This function retrieves and displays a list of the patient's past appointments,
     * including those with a status of 'attended' or 'cancelled'. The appointments are
     * ordered by the service date in descending order and by the time range in ascending order.
     *
     * @return \Illuminate\View\View The view displaying the list of past appointments.
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
