<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * This function retrieves and displays a list of all roles.
     *
     * @return \Illuminate\View\View The view displaying the list of roles.
     */
    public function index()
    {
        // Retrieve all roles
        $roles = Role::all();

        // Return the view with the roles data
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * This function retrieves all permissions and displays the form for creating a new role.
     *
     * @return \Illuminate\View\View The view for creating a new role.
     */
    public function create()
    {
        // Retrieve all permissions
        $permissions = Permission::all();

        // Return the view with the permissions data
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * This function validates and stores a new role in the database,
     * and associates the specified permissions with the role.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing role data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of roles with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'permissions' => 'required|array|min:1',
        ]);

        // Create the role
        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Retrieve permission names from IDs
        $permissions = Permission::whereIn('id', $request->input('permissions'))->pluck('name')->toArray();

        // Associate the permissions with the role
        $role->syncPermissions($permissions);

        // Redirect to the roles index with a success message
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     *
     * This function retrieves all permissions and displays the form for editing the specified role.
     *
     * @param \Spatie\Permission\Models\Role $role The role model instance.
     * @return \Illuminate\View\View The view for editing the role.
     */
    public function edit(Role $role)
    {
        // Retrieve all permissions
        $permissions = Permission::all();

        // Return the view with the role and permissions data
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * This function validates and updates an existing role in the database,
     * and updates the associated permissions for the role.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing updated role data.
     * @param \Spatie\Permission\Models\Role $role The role model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of roles with a success message.
     */
    public function update(Request $request, Role $role)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
            'permissions' => 'required|array|min:1',
        ]);

        // Update the role
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();

        // Retrieve permission names from IDs
        $permissions = Permission::whereIn('id', $request->input('permissions'))->pluck('name')->toArray();

        // Update the associated permissions for the role
        $role->syncPermissions($permissions);

        // Redirect to the roles index with a success message
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     *
     * This function deletes a specific role from the database.
     *
     * @param \Spatie\Permission\Models\Role $role The role model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of roles with a success message.
     */
    public function destroy(Role $role)
    {
        // Delete the role
        $role->delete();

        // Redirect to the roles index with a success message
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
