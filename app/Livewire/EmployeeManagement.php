<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;

class EmployeeManagement extends Component
{
    use WithPagination;

    public $email, $password, $first_name, $last_name, $nid, $phone, $gender, $dob;
    public $employeeId;
    public $isOpen = false;

    protected $listeners = ['create', 'edit', 'destroy'];

    public function render()
    {
        return view('employees.index', [
            'employees' => User::with('profile')->withoutRole('patient')->paginate(10),
        ])->layout('layouts.app');
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['patient', 'medic'])->get();
        return view('employees.create', compact('roles'));
    }

    public function storeEmployee(UserRequest $request)
    {
        app(UserController::class)->store($request);
    }

    public function edit(User $employee)
    {
        $roles = Role::whereNotIn('name', ['patient', 'medic'])->get();
        return view('employees.edit', compact('employee', 'roles'));
    }

    public function updateEmployee(UserRequest $request, User $employee)
    {
        app(UserController::class)->update($request, $employee);
    }

    public function destroy(User $employee)
    {
        app(UserController::class)->destroy($employee);
    }
}
