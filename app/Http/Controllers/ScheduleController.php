<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Day;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('day')->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $days = Day::all()->pluck('name', 'id')->toArray();
        return view('admin.schedules.create', compact('days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_id' => 'required|exists:days,id',
            'time_range' => 'required|string|max:255',
        ]);

        Schedule::create([
            'day_id' => $request->day_id,
            'time_range' => $request->time_range,
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $days = Day::all();
        return view('admin.schedules.edit', compact('schedule', 'days'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'day_id' => 'required|exists:days,id',
            'time_range' => 'required|string|max:255',
        ]);

        $schedule->update([
            'day_id' => $request->day_id,
            'time_range' => $request->time_range,
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
