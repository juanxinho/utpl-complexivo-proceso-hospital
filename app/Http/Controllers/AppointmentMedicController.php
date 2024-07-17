<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentMedicController extends Controller
{
    /**
    * Obtiene la vista de consultas citas del mes actual
    *
    * @return view front.medic.appointments.index
    */
    public function index()
    {
        $appointments = Appointment::whereMonth('service_date', now()->month)
                        ->whereNotIn('status', ['attended','cancelled'])
                        ->whereHas('medicSchedule', function ($query) {
                            $query->where('medic_schedule.id_medic', Auth::id());
                        })
                        ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                        ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                        ->select('appointment.*', 'schedule.time_range')
                        ->orderBy('service_date', 'desc')
                        ->orderBy('schedule.time_range', 'asc')
                        ->paginate(10);

        return view('front.medic.appointments.index', compact('appointments'));
    }

}
