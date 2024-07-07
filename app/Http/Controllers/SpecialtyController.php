<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('searchTerm');
        $status = $request->input('statusFilter');

        $specialties = Specialty::query()
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('abbreviation', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            });

        $specialties = $specialties->paginate(10);

        return view('admin.specialties.index', compact('specialties', 'search', 'status'));
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

        return redirect()->route('admin.specialties.index')->with('success', __('Specialty successfully created.'));
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

        return redirect()->route('admin.specialties.index')->with('success', __('Specialty successfully updated.'));
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()->route('admin.specialties.index')->with('success', __('Specialty successfully eliminated.'));
    }
}
