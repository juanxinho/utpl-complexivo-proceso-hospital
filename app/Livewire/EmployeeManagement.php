<?php

namespace App\Livewire;

use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;

class EmployeeManagement extends Component
{
    use WithPagination;

    public $profile, $email, $password, $roles, $idroles, $id;
    public $employee;
    public $isOpenNew = false;
    public $isOpen = false;


    public function render()
    {
        return view('admin.employees.index', [
            'employees' => User::with('profile')->withoutRole('patient')->paginate(10),
        ])->layout('layouts.app');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenNew = false;
    }

    private function resetInputFields()
    {
        $this->email = '';
        $this->profile['first_name'] = '';
        $this->profile['last_name'] = '';
        $this->profile['nid'] = '';
        $this->profile['phone'] = '';
        $this->profile['gender'] = '';
        $this->profile['dob'] = null;
        $this->idroles = [];
    }

    public function create()
    {
        $this->roles = Role::whereNotIn('name', ['patient'])->get();
        $this->resetInputFields();
        $this->isOpenNew = true;
    }


    public function edit($id)
    {
        $employee = User::with('profile', 'roles')->findOrFail($id);
        $this->id = $id;
        $this->profile = $employee->profile->toArray();
        $this->email = $employee->email;
        $this->roles = Role::whereNotIn('name', ['patient'])->get();
        $this->idroles = $employee->roles->pluck('id')->toArray();
        $this->isOpen = true;
    }
        

    public function store()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->id,
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'profile.phone' => ['required', 'string', 'max:10', new EcuadorPhone],
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
            'idroles' => 'required|array|min:1',
        ]);

        $profile = Profile::updateOrCreate(['id_profile' => $this->id], [
            'first_name' => $this->profile['first_name'],
            'last_name' => $this->profile['last_name'],
            'nid' => $this->profile['nid'],
            'phone' => $this->profile['phone'],
            'gender' => $this->profile['gender'],
            'dob' => $this->profile['dob'],
            'status' => 1,
            'user_register' => auth()->user()->id,
        ]);

        $user = User::updateOrCreate(['id' => $this->id], [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);


        $roles = Role::whereIn('id',  $this->idroles)->get();
        $user->syncRoles($roles);


        session()->flash('message',
            $this->id ? 'Empleado actualizado exitosamente.' : 'Empleado creado exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function destroy(User $employee)
    {
        app(UserController::class)->destroy($employee);
    }
}
