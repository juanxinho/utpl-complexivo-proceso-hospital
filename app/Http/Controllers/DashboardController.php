<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on the user's role.
     *
     * This function determines the user's role and retrieves the next appointment accordingly.
     * It then returns the appropriate view based on whether the user is a patient, medic, or another role.
     *
     * @return \Illuminate\View\View The view for the dashboard based on the user's role.
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user has the 'patient' role
        if ($user->hasRole('patient')) {
            // Retrieve the next upcoming appointment for the patient
            $nextAppointment = Appointment::where('id_patient', $user->id)
                ->whereNotIn('status', ['attended','cancelled'])
                ->where('service_date', '>=', now()->format('Y-m-d'))
                ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                ->select('appointment.*', 'schedule.time_range')
                ->orderBy('service_date', 'asc')
                ->orderBy('schedule.time_range', 'asc')
                ->first();

            // Return the view for patients with the next appointment data
            return view('welcome.patient', compact('user', 'nextAppointment'));

        } elseif ($user->hasRole('medic')) {
            // Retrieve the next appointment for the medic on the current day
            $nextAppointment = Appointment::whereMonth('service_date', now()->month)
                ->whereNotIn('status', ['attended','cancelled'])
                ->where('service_date', '>=', now()->format('Y-m-d'))
                ->whereHas('medicSchedule', function ($query) {
                    $query->where('medic_schedule.id_medic', Auth::id());
                })
                ->join('medic_schedule', 'appointment.medic_schedule_id_medic_schedule', '=', 'medic_schedule.id_medic_schedule')
                ->join('schedule', 'medic_schedule.id_schedule', '=', 'schedule.id_schedule')
                ->select('appointment.*', 'schedule.time_range')
                ->orderBy('schedule.time_range', 'asc')
                ->first();

            // Return the view for medics with the next appointment data
            return view('welcome.medic', compact('user', 'nextAppointment'));

        } else {
            // Obtener el conteo de pacientes atendidos en el trimestre actual
            $patientsAttended = Appointment::where('status', 'attended')->count();

            // Obtener el conteo de pacientes atendidos en el trimestre anterior
            $previousQuarterPatients = Appointment::where('status', 'attended')
                ->whereBetween('service_date', [now()->subMonths(6), now()->subMonths(3)])
                ->count();

            // Evitar la división por cero
            if ($previousQuarterPatients > 0) {
                $percentageChange = ($patientsAttended - $previousQuarterPatients) / $previousQuarterPatients * 100;
            } else {
                $percentageChange = 0;
            }

            // Obtener el conteo de usuarios que no son pacientes en el trimestre actual
            $nonPatientUsers = User::role(['medic', 'admin', 'super-admin', 'technician', 'audit']) // Reemplaza 'medic', 'admin', etc. con los roles que tienes
            ->count();

            // Obtener el conteo de usuarios que no son pacientes en el trimestre anterior
            $previousQuarterUsers = User::role(['medic', 'admin', 'super-admin', 'technician', 'audit'])
                ->whereBetween('created_at', [now()->subMonths(6), now()->subMonths(3)])
                ->count();

            // Evitar la división por cero
            if ($previousQuarterUsers > 0) {
                $percentageChangeUsers = ($nonPatientUsers - $previousQuarterUsers) / $previousQuarterUsers * 100;
            } else {
                $percentageChangeUsers = 0;
            }

            // Obtener las próximas citas del usuario autenticado
            $upcomingAppointments = Appointment::where('service_date', '>=', now())  // Solo citas futuras
            ->where('status', 'scheduled')
            ->orderBy('service_date', 'asc')
                ->take(5)  // Limitar a las próximas 5 citas
                ->get();

            // For other roles, return a generic welcome view
            return view('welcome.welcome', compact('upcomingAppointments', 'nonPatientUsers', 'percentageChangeUsers', 'patientsAttended', 'percentageChange', 'user'));
        }
    }
}
