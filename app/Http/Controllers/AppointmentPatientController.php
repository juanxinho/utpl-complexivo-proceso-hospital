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
    * Obtiene la vista de consultas citas admin
    *
    * @return view admin.appointments.index
    */
    public function index()
    {
        $appointments = Appointment::paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
    * Obtiene la vista de consulta citas paciente
    *
    * @return view front.patient.appointments.show
    */
    public function show()
    {
        $appointments = Appointment::where('id_patient', Auth::id())
            ->where('service_date', '>=', now())
            ->orderBy('service_date', 'asc')
            ->get();
        return view('front.patient.appointments.show', compact('appointments'));
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

    public function create()
    {
        $medicosHorarios = MedicSchedule::all();
        $usuariosRoles = UsuarioRol::all();
        return view('admin.appointments.create', compact('medicosHorarios', 'usuariosRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medic_schedule_id_medic_schedule' => 'required|exists:medic_schedule,id_medic_schedule',
            'id_patient' => 'required|exists:usuario_rol,idusuario_rol',
            'service_date' => 'required|date|after:now',
        ]);

        Appointment::create([
            'user_register' => Auth::id(),
            'medic_schedule_id_medic_schedule' => $request->medic_schedule_id_medic_schedule,
            'id_patient' => $request->id_patient,
            'service_date' => $request->service_date,
            'status' => 'pendiente',
        ]);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment creada exitosamente.');
    }


    public function edit(Appointment $appointment)
    {
        //$this->authorize('update', $appointment);
        $medicosHorarios = MedicSchedule::all();
        $usuariosRoles = UsuarioRol::all();
        return view('admin.appointments.edit', compact('appointment', 'medicosHorarios', 'usuariosRoles'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        //$this->authorize('update', $appointment);

        $request->validate([
            'medic_schedule_id_medic_schedule' => 'required|exists:medic_schedule,id_medic_schedule',
            'id_patient' => 'required|exists:usuario_rol,idusuario_rol',
            'service_date' => 'required|date|after:now',
        ]);

        $appointment->update([
            'medic_schedule_id_medic_schedule' => $request->medic_schedule_id_medic_schedule,
            'id_patient' => $request->id_patient,
            'service_date' => $request->service_date,
        ]);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment actualizada exitosamente.');
    }

    public function destroy(Appointment $appointment)
    {
        //$this->authorize('delete', $appointment);
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment eliminada exitosamente.');
    }

    public function patientAppointments(Request $request)
    {
        //$this->authorize('viewAny', Appointment::class);

        // Fetch patient data with profile fields
        $appointments = Appointment::with('medicSchedule')
            ->where('id_patient', Auth::id())
            ->paginate(10);
        //return view('admin.appointments.index', compact('appointments'));
        return view('admin.appointments.show', compact('appointments', 'patients'));
    }
}
