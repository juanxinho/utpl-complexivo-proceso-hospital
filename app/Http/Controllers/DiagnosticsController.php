<?php

namespace App\Http\Controllers;

use App\Models\Diagnostics;
use Illuminate\Http\Request;

class DiagnosticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This function retrieves and displays a paginated list of diagnostics.
     * It supports searching by code and description.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing search parameters.
     * @return \Illuminate\View\View The view displaying the list of diagnostics.
     */
    public function index(Request $request)
    {
        // Retrieve the search term from the request
        $search = $request->input('searchTerm');

        // Query diagnostics with optional search term filtering
        $diagnostics = Diagnostics::query()
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('code', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            });

        // Paginate the results
        $diagnostics = $diagnostics->paginate(10);

        // Return the view with the diagnostics data
        return view('admin.diagnostics.index', compact('diagnostics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * This function returns the view for creating a new diagnostic.
     *
     * @return \Illuminate\View\View The view for creating a new diagnostic.
     */
    public function create()
    {
        return view('admin.diagnostics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * This function validates and stores a new diagnostic in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing diagnostic data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of diagnostics with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => 'required|unique:diagnostics|max:10',
            'description' => 'string|max:255',
        ]);

        // Create the diagnostic
        Diagnostics::create($request->all());

        // Redirect to the diagnostics index with a success message
        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * This function retrieves and displays a specific diagnostic.
     *
     * @param \App\Models\Diagnostics $diagnostic The diagnostic model instance.
     * @return \Illuminate\View\View The view displaying the diagnostic details.
     */
    public function show(Diagnostics $diagnostic)
    {
        return view('admin.diagnostics.show', compact('diagnostic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This function returns the view for editing a specific diagnostic.
     *
     * @param \App\Models\Diagnostics $diagnostic The diagnostic model instance.
     * @return \Illuminate\View\View The view for editing the diagnostic.
     */
    public function edit(Diagnostics $diagnostic)
    {
        return view('admin.diagnostics.edit', compact('diagnostic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * This function validates and updates an existing diagnostic in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing updated diagnostic data.
     * @param \App\Models\Diagnostics $diagnostic The diagnostic model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of diagnostics with a success message.
     */
    public function update(Request $request, Diagnostics $diagnostic)
    {
        // Validate the request data
        $request->validate([
            'code' => 'required|max:10|unique:diagnostics,code,' . $diagnostic->code,
            'description' => 'string|max:255',
        ]);

        // Update the diagnostic
        $diagnostic->update($request->all());

        // Redirect to the diagnostics index with a success message
        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * This function deletes a specific diagnostic from the database.
     *
     * @param \App\Models\Diagnostics $diagnostic The diagnostic model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of diagnostics with a success message.
     */
    public function destroy(Diagnostics $diagnostic)
    {
        // Delete the diagnostic
        $diagnostic->delete();

        // Redirect to the diagnostics index with a success message
        return redirect()->route('admin.diagnostics.index')
            ->with('success', __('Diagnostic detail deleted successfully.'));
    }
}

