<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\UsuarioRol;
use App\Models\MedicoHorario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('medicoHorario', 'usuarioRol')->where('usuario_rol_idusuario_rol', Auth::id())->get();
        return view('citas.index', compact('citas'));
    }

    public function medicoIndex()
    {
        $citas = Cita::with('usuarioRol')->whereHas('medicoHorario', function ($query) {
            $query->where('usuario_rol_idusuario_rol', Auth::id());
        })->get();
        return view('citas.medico_index', compact('citas'));
    }

    public function create()
    {
        $medicosHorarios = MedicoHorario::all();
        $usuariosRoles = UsuarioRol::all();
        return view('citas.create', compact('medicosHorarios', 'usuariosRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medico_horario_idmedico_horario' => 'required|exists:medico_horario,idmedico_horario',
            'usuario_rol_idusuario_rol' => 'required|exists:usuario_rol,idusuario_rol',
            'fecha_atencion' => 'required|date|after:now',
        ]);

        Cita::create([
            'usuario_registro' => Auth::id(),
            'medico_horario_idmedico_horario' => $request->medico_horario_idmedico_horario,
            'usuario_rol_idusuario_rol' => $request->usuario_rol_idusuario_rol,
            'fecha_atencion' => $request->fecha_atencion,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }

    public function show(Cita $cita)
    {
        $this->authorize('view', $cita);
        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $this->authorize('update', $cita);
        $medicosHorarios = MedicoHorario::all();
        $usuariosRoles = UsuarioRol::all();
        return view('citas.edit', compact('cita', 'medicosHorarios', 'usuariosRoles'));
    }

    public function update(Request $request, Cita $cita)
    {
        $this->authorize('update', $cita);

        $request->validate([
            'medico_horario_idmedico_horario' => 'required|exists:medico_horario,idmedico_horario',
            'usuario_rol_idusuario_rol' => 'required|exists:usuario_rol,idusuario_rol',
            'fecha_atencion' => 'required|date|after:now',
        ]);

        $cita->update([
            'medico_horario_idmedico_horario' => $request->medico_horario_idmedico_horario,
            'usuario_rol_idusuario_rol' => $request->usuario_rol_idusuario_rol,
            'fecha_atencion' => $request->fecha_atencion,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        $this->authorize('delete', $cita);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
