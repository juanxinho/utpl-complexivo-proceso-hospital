<?php

namespace App\Http\Controllers;

use App\Models\Diagnostics;
use Illuminate\Http\Request;

class DiagnosticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('searchTerm');

        $diagnosticDetails = Diagnostics::query()
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('code', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            });

        $diagnosticDetails = $diagnosticDetails->paginate(10);

        return view('admin.diagnostics.index', compact('diagnosticDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.diagnostics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:diagnostics|max:10',
            'description' => 'string|max:255',
        ]);

        Diagnostics::create($request->all());

        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnostics $diagnosticDetail)
    {
        return view('admin.diagnostics.show', compact('diagnosticDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnostics $diagnosticDetail)
    {
        return view('admin.diagnostics.edit', compact('diagnosticDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnostics $diagnosticDetail)
    {
        $request->validate([
            'code' => 'required|max:10|unique:diagnostics,code,' . $diagnosticDetail->code,
            'description' => 'string|max:255',
        ]);

        $diagnosticDetail->update($request->all());

        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostics $diagnosticDetail)
    {
        $diagnosticDetail->delete();

        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail deleted successfully.'));
    }
}
