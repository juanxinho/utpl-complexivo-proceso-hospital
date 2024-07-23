<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
    * Obtiene la vista de consultas citas
    *
    * @return view admin.appointments.index
    */
    public function index(Request $request)
    {
        $search = $request->input('searchTerm');
        $status = $request->input('statusFilter');

        $appointments = Appointment::paginate(10);

        $appointments = Appointment::query()
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('service_date', 'desc');

        $appointments = $appointments->paginate(10);

        return view('admin.appointments.index', compact('appointments', 'search', 'status'));
    }

    /**
    * Obtiene la vista de detalle por cita
    *
    * @return view front.patient.appointments.show
    */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        session()->flash('flash.banner', __('Appointment cancelled successfully.'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('admin.appointments.index');
    }

}
