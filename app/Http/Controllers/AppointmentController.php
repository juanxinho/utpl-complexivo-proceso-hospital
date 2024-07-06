<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('medicSchedule', 'usuarioRol')->where('id_patient', Auth::id())->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function medicIndex()
    {
        $appointments = Appointment::with('usuarioRol')->whereHas('medicSchedule', function ($query) {
            $query->where('id_patient', Auth::id());
        })->get();
        return view('admin.appointments.medic_index', compact('appointments'));
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

    public function show(Appointment $appointment)
    {
        //$this->authorize('view', $appointment);
        return view('front.patient.appointments.show', compact('appointment'));
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

    public function Singleshow($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('front.patient.appointments.show', compact('appointment'));
    }

    public function history()
    {
        $user = Auth::user();
        $appointments = Appointment::where('id_patient', $user->id)
            ->where('service_date', '>=', now())
            ->orderBy('service_date', 'asc')
            ->get();

        //$appointments = Appointment::where('patient_id', Auth::id())->where('date', '<', now())->orderBy('date', 'desc')->get();
        return view('front.patient.appointments.history', compact('appointments'));
    }

    public function patientAppointments(Request $request)
    {
        //$this->authorize('viewAny', Appointment::class);

        // Fetch patient data with profile fields
        $patients = User::role('patient')
            ->join('profile', 'users.id_profile', '=', 'profile.id_profile')
            ->selectRaw('users.id, CONCAT(profile.first_name, " ", profile.last_name) as name')
            ->pluck('name', 'users.id');

        $appointments = collect();

        if ($request->has('patient_id')) {
            $appointments = Appointment::where('id_patient', $request->patient_id)
                ->where('service_date', '>=', now())
                ->orderBy('service_date', 'asc')
                ->get();
        }

        //$this->authorize('view', $appointment);
        return view('admin.appointments.patient_appointments', compact('appointments', 'patients'));
    }
}
