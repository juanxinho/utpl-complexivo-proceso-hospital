<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $nextAppointment = Appointment::where('patient_id', $user->id)->where('date', '>=', now())->orderBy('date', 'asc')->first();
        $appointmentHistory = Appointment::where('patient_id', $user->id)->where('date', '<', now())->orderBy('date', 'desc')->get();

        return view('welcome.patient', compact('user', 'nextAppointment', 'appointmentHistory'));
    }
}
