<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('patient')) {

            $nextAppointment = Appointment::where('id_patient', $user->id)
                ->whereNotIn('status', ['attended','cancelled'])
                ->where('service_date', '>=', now()->format('Y-m-d'))
                ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                ->select('appointment.*', 'schedule.time_range')
                ->orderBy('service_date', 'asc')
                ->orderBy('schedule.time_range', 'asc')
                ->first();    

            return view('welcome.patient', compact('user', 'nextAppointment'));

        } elseif ($user->hasRole('medic')) {

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

            return view('welcome.medic', compact('user', 'nextAppointment'));

        } else {
            // For other roles
            return view('welcome.welcome', compact('user'));
        }
    }
}
