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
            // Add logic specific to 'medic' role if needed
            return view('welcome.medic', compact('user'));
        } else {
            // For other roles
            return view('welcome.welcome', compact('user'));
        }
    }
}
