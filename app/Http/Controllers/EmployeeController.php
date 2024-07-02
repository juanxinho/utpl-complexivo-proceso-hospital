<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::whereHas('roles', function ($query) {
            $query->whereNotIn('name', ['patient', 'medic']);
        })->with('profile')->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['patient', 'medic'])->get();
        return view('employees.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'profile.phone' => ['required', 'string', 'max:10', new EcuadorPhone],
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
            'roles' => 'required|array|min:1',
        ]);

        $profile = Profile::create($request->input('profile'));

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_profile' => $profile->id,
            'estado' => 1,
            'usuario_registro' => auth()->user()->id,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(User $employee)
    {
        $roles = Role::whereNotIn('name', ['patient', 'medic'])->get();
        return view('employees.edit', compact('employee', 'roles'));
    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => 'required|string|max:13|unique:profiles,nid,' . $employee->id_profile,
            'profile.phone' => 'required|string|max:10',
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
            'roles' => 'required|array|min:1',
        ]);

        $employee->profile->update($request->input('profile'));

        $employee->update([
            'email' => $request->email,
        ]);

        if ($request->password) {
            $employee->update(['password' => Hash::make($request->password)]);
        }

        $employee->syncRoles($request->roles);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}

