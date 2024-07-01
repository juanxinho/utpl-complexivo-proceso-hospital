<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('medicSchedule', 'usuarioRol')->where('usuario_rol_idusuario_rol', Auth::id())->get();
        return view('appointments.index', compact('appointments'));
    }

    public function medicoIndex()
    {
        $appointments = Appointment::with('usuarioRol')->whereHas('medicSchedule', function ($query) {
            $query->where('usuario_rol_idusuario_rol', Auth::id());
        })->get();
        return view('appointments.medic_index', compact('appointments'));
    }

    public function create()
    {
        $medicosHorarios = MedicSchedule::all();
        $usuariosRoles = UsuarioRol::all();
        return view('appointments.create', compact('medicosHorarios', 'usuariosRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medic_schedule_id_medic_schedule' => 'required|exists:medic_schedule,id_medic_schedule',
            'usuario_rol_idusuario_rol' => 'required|exists:usuario_rol,idusuario_rol',
            'service_date' => 'required|date|after:now',
        ]);

        Appointment::create([
            'user_register' => Auth::id(),
            'medic_schedule_id_medic_schedule' => $request->medic_schedule_id_medic_schedule,
            'usuario_rol_idusuario_rol' => $request->usuario_rol_idusuario_rol,
            'service_date' => $request->service_date,
            'status' => 'pendiente',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment creada exitosamente.');
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        $medicosHorarios = MedicSchedule::all();
        $usuariosRoles = UsuarioRol::all();
        return view('appointments.edit', compact('appointment', 'medicosHorarios', 'usuariosRoles'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $request->validate([
            'medic_schedule_id_medic_schedule' => 'required|exists:medic_schedule,id_medic_schedule',
            'usuario_rol_idusuario_rol' => 'required|exists:usuario_rol,idusuario_rol',
            'service_date' => 'required|date|after:now',
        ]);

        $appointment->update([
            'medic_schedule_id_medic_schedule' => $request->medic_schedule_id_medic_schedule,
            'usuario_rol_idusuario_rol' => $request->usuario_rol_idusuario_rol,
            'service_date' => $request->service_date,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment actualizada exitosamente.');
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment eliminada exitosamente.');
    }
}
