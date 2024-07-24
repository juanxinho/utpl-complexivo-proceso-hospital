<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on the user's role.
     *
     * This function determines the user's role and retrieves the next appointment accordingly.
     * It then returns the appropriate view based on whether the user is a patient, medic, or another role.
     *
     * @return \Illuminate\View\View The view for the dashboard based on the user's role.
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user has the 'patient' role
        if ($user->hasRole('patient')) {
            // Retrieve the next upcoming appointment for the patient
            $nextAppointment = Appointment::where('id_patient', $user->id)
                ->whereNotIn('status', ['attended','cancelled'])
                ->where('service_date', '>=', now()->format('Y-m-d'))
                ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                ->select('appointment.*', 'schedule.time_range')
                ->orderBy('service_date', 'asc')
                ->orderBy('schedule.time_range', 'asc')
                ->first();

            // Return the view for patients with the next appointment data
            return view('welcome.patient', compact('user', 'nextAppointment'));

        } elseif ($user->hasRole('medic')) {
            // Retrieve the next appointment for the medic on the current day
            $nextAppointment = Appointment::whereMonth('service_date', now()->month)
                ->whereNotIn('status', ['attended','cancelled'])
                ->where('service_date', '=', now()->format('Y-m-d'))
                ->whereHas('medicSchedule', function ($query) {
                    $query->where('medic_schedule.id_medic', Auth::id());
                })
                ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                ->select('appointment.*', 'schedule.time_range')
                ->orderBy('schedule.time_range', 'asc')
                ->first();

            // Return the view for medics with the next appointment data
            return view('welcome.medic', compact('user', 'nextAppointment'));

        } else {
            // For other roles, return a generic welcome view
            return view('welcome.welcome', compact('user'));
        }
    }
}
