<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicoHorario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('medicoHorario', 'usuarioRol')->where('usuario_rol_idusuario_rol', Auth::id())->get();
        return view('appointments.index', compact('appointments'));
    }

    public function medicoIndex()
    {
        $appointments = Appointment::with('usuarioRol')->whereHas('medicoHorario', function ($query) {
            $query->where('usuario_rol_idusuario_rol', Auth::id());
        })->get();
        return view('appointments.medic_index', compact('appointments'));
    }

    public function create()
    {
        $medicosHorarios = MedicoHorario::all();
        $usuariosRoles = UsuarioRol::all();
        return view('appointments.create', compact('medicosHorarios', 'usuariosRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medico_horario_idmedico_horario' => 'required|exists:medico_horario,idmedico_horario',
            'usuario_rol_idusuario_rol' => 'required|exists:usuario_rol,idusuario_rol',
            'fecha_atencion' => 'required|date|after:now',
        ]);

        Appointment::create([
            'usuario_registro' => Auth::id(),
            'medico_horario_idmedico_horario' => $request->medico_horario_idmedico_horario,
            'usuario_rol_idusuario_rol' => $request->usuario_rol_idusuario_rol,
            'fecha_atencion' => $request->fecha_atencion,
            'estado' => 'pendiente',
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
        $medicosHorarios = MedicoHorario::all();
        $usuariosRoles = UsuarioRol::all();
        return view('appointments.edit', compact('appointment', 'medicosHorarios', 'usuariosRoles'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $request->validate([
            'medico_horario_idmedico_horario' => 'required|exists:medico_horario,idmedico_horario',
            'usuario_rol_idusuario_rol' => 'required|exists:usuario_rol,idusuario_rol',
            'fecha_atencion' => 'required|date|after:now',
        ]);

        $appointment->update([
            'medico_horario_idmedico_horario' => $request->medico_horario_idmedico_horario,
            'usuario_rol_idusuario_rol' => $request->usuario_rol_idusuario_rol,
            'fecha_atencion' => $request->fecha_atencion,
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
