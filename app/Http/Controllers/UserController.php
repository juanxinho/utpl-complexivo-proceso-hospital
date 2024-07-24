<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param \App\Services\UserService $userService The service layer to handle user-related operations.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     *
     * This function retrieves and displays a list of all users.
     *
     * @return \Illuminate\View\View The view displaying the list of users.
     */
    public function index()
    {
        // Retrieve all users
        $users = $this->userService->getAllUsers();

        // Return the view with the users data
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * This function retrieves all roles and displays the form for creating a new user.
     *
     * @return \Illuminate\View\View The view for creating a new user.
     */
    public function create()
    {
        // Retrieve all roles
        $roles = $this->userService->getAllRoles();

        // Return the view with the roles data
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * This function validates and stores a new user in the database.
     *
     * @param \App\Http\Requests\UserRequest $request The HTTP request object containing user data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of users with a success message.
     */
    public function store(UserRequest $request)
    {
        // Create the user using the validated data
        $this->userService->createUser($request->validated());

        // Redirect to the users index with a success message
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * This function retrieves the user and all roles, and displays the form for editing the user.
     *
     * @param int $id The ID of the user to edit.
     * @return \Illuminate\View\View The view for editing the user.
     */
    public function edit($id)
    {
        // Retrieve the user by ID and all roles
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getAllRoles();

        // Return the view with the user and roles data
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * This function validates and updates an existing user in the database.
     *
     * @param \App\Http\Requests\UserRequest $request The HTTP request object containing updated user data.
     * @param int $id The ID of the user to update.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of users with a success message.
     */
    public function update(UserRequest $request, $id)
    {
        // Update the user using the validated data
        $this->userService->updateUser($id, $request->validated());

        // Redirect to the users index with a success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * This function deletes a specific user from the database.
     *
     * @param int $id The ID of the user to delete.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of users with a success message.
     */
    public function destroy($id)
    {
        // Delete the user
        $this->userService->deleteUser($id);

        // Redirect to the users index with a success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
