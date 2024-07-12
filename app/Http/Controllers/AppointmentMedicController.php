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
dd($appointments);
        return view('front.medic.appointments.index', compact('appointments'));
    }


    /**
    * Obtiene la vista de consulta citas paciente
    *
    * @return view front.patient.appointments.show
    */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('front.medic.appointments.show', compact('appointment'));
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

}
