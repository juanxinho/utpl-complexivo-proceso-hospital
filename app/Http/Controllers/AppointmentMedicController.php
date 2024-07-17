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
    * Obtiene la vista de consultas citas
    *
    * @return view front.medic.appointments.index
    */
    public function index()
    {
        $appointments = Appointment::whereMonth('service_date', now()->month)
                        ->where('status', '!=', 'attended')
                        ->whereHas('medicSchedule', function ($query) {
                                    $query->where('medic_schedule.id_medic', Auth::id());})
                        ->orderBy('service_date', 'asc')
                        ->paginate(10);

        return view('front.medic.appointments.index', compact('appointments'));
    }

}
