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
    * Obtiene la vista de proximas citas paciente
    *
    * @return view front.patient.appointments.next
    */
    public function next()
    {
        $appointments = Appointment::where('id_patient', Auth::id())
                                    ->where('service_date', '>=', now())
                                    ->where('status', '!=', 'cancelled')
                                    ->orderBy('service_date', 'asc')
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
                                    ->where('service_date', '<=', now())
                                    ->orderBy('service_date', 'asc')
                                    ->paginate(10);

        return view('front.patient.appointments.history', compact('appointments'));
    }

}
