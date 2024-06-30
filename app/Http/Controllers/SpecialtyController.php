<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'abreviatura' => 'nullable|string|max:45',
            'descripcion' => 'nullable|string|max:45',
            'estado' => 'required|boolean',
        ]);

        Specialty::create($request->all());

        return redirect()->route('specialties.index')->with('success', 'Especialidad creada exitosamente.');
    }

    public function show(Specialty $specialty)
    {
        return view('specialties.show', compact('specialty'));
    }

    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'abreviatura' => 'nullable|string|max:45',
            'descripcion' => 'nullable|string|max:45',
            'estado' => 'required|boolean',
        ]);

        $specialty->update($request->all());

        return redirect()->route('specialties.index')->with('success', 'Especialidad actualizada exitosamente.');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()->route('specialties.index')->with('success', 'Especialidad eliminada exitosamente.');
    }
}
