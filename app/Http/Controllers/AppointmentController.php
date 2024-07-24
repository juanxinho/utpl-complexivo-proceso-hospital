<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     *
     * This function retrieves and displays a paginated list of appointments.
     * It filters appointments based on the provided search term and status filter.
     * The appointments are ordered by the service date in descending order.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing search and filter parameters.
     * @return \Illuminate\View\View The view displaying the list of appointments.
     */
    public function index(Request $request)
    {
        // Retrieve search and status filter from the request
        $search = $request->input('searchTerm');
        $status = $request->input('statusFilter');

        // Initialize the appointment query and apply filters
        $appointments = Appointment::query()
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('service_date', 'desc');

        // Paginate the results
        $appointments = $appointments->paginate(10);

        // Return the view with the appointments data
        return view('admin.appointments.index', compact('appointments', 'search', 'status'));
    }

    /**
     * Display the specified appointment.
     *
     * This function retrieves and displays the details of a specific appointment
     * based on the provided appointment ID.
     *
     * @param int $id The ID of the appointment to display.
     * @return \Illuminate\View\View The view displaying the appointment details.
     */
    public function show($id)
    {
        // Find the appointment by ID or fail if not found
        $appointment = Appointment::findOrFail($id);

        // Return the view with the appointment data
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Cancel the specified appointment.
     *
     * This function updates the status of a specific appointment to 'cancelled'.
     * It then sets a flash message indicating the appointment was cancelled successfully
     * and redirects the user to the list of appointments.
     *
     * @param \App\Models\Appointment $appointment The appointment to cancel.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of appointments.
     */
    public function destroy(Appointment $appointment)
    {
        // Update the appointment status to 'cancelled'
        $appointment->update(['status' => 'cancelled']);

        // Set a flash message indicating the appointment was cancelled successfully
        session()->flash('flash.banner', __('Appointment cancelled successfully.'));
        session()->flash('flash.bannerStyle', 'success');

        // Redirect to the list of appointments
        return redirect()->route('admin.appointments.index');
    }
}
