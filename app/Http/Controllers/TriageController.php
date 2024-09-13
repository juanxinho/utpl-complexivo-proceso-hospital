<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Triage;

class TriageController extends Controller
{
    public function create()
    {
        $patients = User::role('patient')->get();
        return view('admin.triage.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'heart_rate' => 'required|integer|between:60,100',
            'respiratory_rate' => 'required|integer|between:12,20',
            'systolic_blood_pressure' => 'required|integer|between:120,129',
            'diastolic_blood_pressure' => 'required|integer|between:80,84',
            'temperature' => 'required|numeric|between:12,40',
            'spo2' => 'required|integer|between:70,100',
            'priority' => 'required|in:Alto,Medio,Bajo',
        ]);

        Triage::create($request->all());

        session()->flash('flash.banner', __('Triaje registrado exitosamente.'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('admin.triage.index')->with('success', 'Triaje registrado exitosamente.');
    }

    public function index(Request $request)
    {
        $search = $request->input('searchTerm');
        $status = $request->input('statusFilter');

        // Query Triage with optional search term filtering
        $triages = Triage::with('patient')
            ->when($search, function ($query, $search) {
                $query->whereHas('patient.profile', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%');
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('priority', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //$triages = Triage::with('patient')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.triage.index', compact('triages'));
    }

    public function show(Triage $triage)
    {
        return view('admin.triage.show', compact('triage'));
    }

    public function edit(Triage $triage)
    {
        $patients = User::role('patient')->get();
        return view('admin.triage.edit', compact('triage', 'patients'));
    }

    public function update(Request $request, Triage $triage)
    {
        $request->validate([
            'heart_rate' => 'required|integer|between:60,100',
            'respiratory_rate' => 'required|integer|between:12,20',
            'systolic_blood_pressure' => 'required|integer|between:120,129',
            'diastolic_blood_pressure' => 'required|integer|between:80,84',
            'temperature' => 'required|numeric|between:12,40',
            'spo2' => 'required|integer|between:70,100',
            'priority' => 'required|in:Alto,Medio,Bajo',
        ]);

        $triage->update($request->all());

        session()->flash('flash.banner', __('Triaje actualizado exitosamente.'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('admin.triage.index')->with('success', 'Triaje actualizado exitosamente.');
    }

    public function destroy(Triage $triage)
    {
        $triage->delete();

        session()->flash('flash.banner', __('Triaje eliminado exitosamente.'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('admin.triage.index')->with('success', 'Triaje eliminado exitosamente.');
    }
}
