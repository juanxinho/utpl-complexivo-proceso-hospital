<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->userService->getAllRoles();
        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getAllRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->userService->updateUser($id, $request->validated());
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function assignSpecialties(Request $request, $userId)
    {
        $this->userService->assignSpecialties($userId, $request->specialties);

        return redirect()->route('admin.users.index')->with('success', 'Specialties assigned successfully.');
    }

    public function storeMedic(UserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.medics.index')->with('success', 'Medic created successfully.');
    }

    public function updateMedic(UserRequest $request, User $medic)
    {
        $this->userService->updateUser($medic, $request->validated());

        return redirect()->route('admin.medics.index')->with('success', 'Medic updated successfully.');
    }
}
