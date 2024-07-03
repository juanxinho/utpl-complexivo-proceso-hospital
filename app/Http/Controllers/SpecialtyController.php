<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('admin.specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('admin.specialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'abbreviation' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45',
            'status' => 'required|boolean',
        ]);

        Specialty::create($request->all());

        return redirect()->route('admin.specialties.index')->with('success', 'Especialidad creada exitosamente.');
    }

    public function show(Specialty $specialty)
    {
        return view('admin.specialties.show', compact('specialty'));
    }

    public function edit(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'abbreviation' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45',
            'status' => 'required|boolean',
        ]);

        $specialty->update($request->all());

        return redirect()->route('admin.specialties.index')->with('success', 'Especialidad actualizada exitosamente.');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()->route('admin.specialties.index')->with('success', 'Especialidad eliminada exitosamente.');
    }
}
