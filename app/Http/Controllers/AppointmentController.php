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
            /*->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('abbreviation', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })*/
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            });

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
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment cancelled successfully.');
    }

}
