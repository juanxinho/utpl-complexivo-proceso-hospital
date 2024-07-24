<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Day;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the schedules.
     *
     * This function retrieves and displays a paginated list of schedules, including the associated day information.
     *
     * @return \Illuminate\View\View The view displaying the list of schedules.
     */
    public function index()
    {
        // Retrieve paginated schedules with associated day information
        $schedules = Schedule::with('day')->paginate(10);

        // Return the view with the schedules data
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     *
     * This function retrieves all days and displays the form for creating a new schedule.
     *
     * @return \Illuminate\View\View The view for creating a new schedule.
     */
    public function create()
    {
        // Retrieve all days and pluck the name and id
        $days = Day::all()->pluck('name', 'id')->toArray();

        // Return the view with the days data
        return view('admin.schedules.create', compact('days'));
    }

    /**
     * Store a newly created schedule in storage.
     *
     * This function validates and stores a new schedule in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing schedule data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of schedules with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'day_id' => 'required|exists:days,id',
            'time_range' => 'required|string|max:255',
        ]);

        // Create the schedule
        Schedule::create([
            'day_id' => $request->day_id,
            'time_range' => $request->time_range,
        ]);

        // Redirect to the schedules index with a success message
        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    /**
     * Show the form for editing the specified schedule.
     *
     * This function retrieves the schedule and all days, and displays the form for editing the schedule.
     *
     * @param \App\Models\Schedule $schedule The schedule model instance.
     * @return \Illuminate\View\View The view for editing the schedule.
     */
    public function edit(Schedule $schedule)
    {
        // Retrieve all days
        $days = Day::all();

        // Return the view with the schedule and days data
        return view('admin.schedules.edit', compact('schedule', 'days'));
    }

    /**
     * Update the specified schedule in storage.
     *
     * This function validates and updates an existing schedule in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing updated schedule data.
     * @param \App\Models\Schedule $schedule The schedule model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of schedules with a success message.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Validate the request data
        $request->validate([
            'day_id' => 'required|exists:days,id',
            'time_range' => 'required|string|max:255',
        ]);

        // Update the schedule
        $schedule->update([
            'day_id' => $request->day_id,
            'time_range' => $request->time_range,
        ]);

        // Redirect to the schedules index with a success message
        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified schedule from storage.
     *
     * This function deletes a specific schedule from the database.
     *
     * @param \App\Models\Schedule $schedule The schedule model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of schedules with a success message.
     */
    public function destroy(Schedule $schedule)
    {
        // Delete the schedule
        $schedule->delete();

        // Redirect to the schedules index with a success message
        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
