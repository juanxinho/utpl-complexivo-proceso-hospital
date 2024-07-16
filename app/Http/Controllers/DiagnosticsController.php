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

        $diagnostics = Diagnostics::query()
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('code', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            });

        $diagnostics = $diagnostics->paginate(10);

        return view('admin.diagnostics.index', compact('diagnostics'));
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
    public function show(Diagnostics $diagnostic)
    {
        return view('admin.diagnostics.show', compact('diagnostic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnostics $diagnostic)
    {
        return view('admin.diagnostics.edit', compact('diagnostic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnostics $diagnostic)
    {
        $request->validate([
            'code' => 'required|max:10|unique:diagnostics,code,' . $diagnostic->code,
            'description' => 'string|max:255',
        ]);

        $diagnostic->update($request->all());

        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostics $diagnostic)
    {
        $diagnostic->delete();

        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail deleted successfully.'));
    }
}
