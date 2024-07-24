<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the specialties.
     *
     * This function retrieves and displays a paginated list of specialties.
     * It supports filtering by search term and status.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing search and filter parameters.
     * @return \Illuminate\View\View The view displaying the list of specialties.
     */
    public function index(Request $request)
    {
        // Retrieve search term and status filter from the request
        $search = $request->input('searchTerm');
        $status = $request->input('statusFilter');

        // Query specialties with optional search term and status filtering
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

        // Paginate the results
        $specialties = $specialties->paginate(10);

        // Return the view with the specialties data
        return view('admin.specialties.index', compact('specialties', 'search', 'status'));
    }

    /**
     * Show the form for creating a new specialty.
     *
     * This function returns the view for creating a new specialty.
     *
     * @return \Illuminate\View\View The view for creating a new specialty.
     */
    public function create()
    {
        return view('admin.specialties.create');
    }

    /**
     * Store a newly created specialty in storage.
     *
     * This function validates and stores a new specialty in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing specialty data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of specialties with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:45',
            'abbreviation' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45',
            'status' => 'required|boolean',
        ]);

        // Create the specialty
        Specialty::create($request->all());

        // Redirect to the specialties index with a success message
        return redirect()->route('admin.specialties.index')
            ->with('success', __('Specialty successfully created.'));
    }

    /**
     * Display the specified specialty.
     *
     * This function retrieves and displays a specific specialty.
     *
     * @param \App\Models\Specialty $specialty The specialty model instance.
     * @return \Illuminate\View\View The view displaying the specialty details.
     */
    public function show(Specialty $specialty)
    {
        return view('admin.specialties.show', compact('specialty'));
    }

    /**
     * Show the form for editing the specified specialty.
     *
     * This function returns the view for editing a specific specialty.
     *
     * @param \App\Models\Specialty $specialty The specialty model instance.
     * @return \Illuminate\View\View The view for editing the specialty.
     */
    public function edit(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified specialty in storage.
     *
     * This function validates and updates an existing specialty in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing updated specialty data.
     * @param \App\Models\Specialty $specialty The specialty model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of specialties with a success message.
     */
    public function update(Request $request, Specialty $specialty)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:45',
            'abbreviation' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45',
            'status' => 'required|boolean',
        ]);

        // Update the specialty
        $specialty->update($request->all());

        // Redirect to the specialties index with a success message
        return redirect()->route('admin.specialties.index')
            ->with('success', __('Specialty successfully updated.'));
    }

    /**
     * Remove the specified specialty from storage.
     *
     * This function deletes a specific specialty from the database.
     *
     * @param \App\Models\Specialty $specialty The specialty model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of specialties with a success message.
     */
    public function destroy(Specialty $specialty)
    {
        // Delete the specialty
        $specialty->delete();

        // Redirect to the specialties index with a success message
        return redirect()->route('admin.specialties.index')
            ->with('success', __('Specialty successfully eliminated.'));
    }
}
