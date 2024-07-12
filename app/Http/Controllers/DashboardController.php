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
                ->where('service_date', '>=', now())
                ->orderBy('service_date', 'asc')
                ->first();

            $appointmentHistory = Appointment::where('id_patient', $user->id)
                ->where('service_date', '<', now())
                ->orderBy('service_date', 'desc')
                ->get();

            return view('welcome.patient', compact('user', 'nextAppointment', 'appointmentHistory'));
        } elseif ($user->hasRole('medic')) {
            $nextAppointment = Appointment::whereMonth('service_date', now()->month)
                ->where('status', '!=', 'attended')
                ->whereHas('medicSchedule', function ($query) {
                            $query->where('medic_schedule.id_medic', Auth::id());})
                ->orderBy('service_date', 'asc')
                ->first();
            return view('welcome.medic', compact('user', 'nextAppointment'));
        } else {
            // For other roles
            return view('welcome.welcome', compact('user'));
        }
    }
}
