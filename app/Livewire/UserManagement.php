<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserManagement extends Component
{
    use WithPagination;

    public $users, $roles, $profile, $name, $email, $password, $idusuario, $idroles, $id;
    public $isOpen = 0;

    public function render()
    {
        $this->users = User::with('roles', 'profile')->get();
        $this->roles = Role::all();
        return view('users.index')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->email = '';
        $this->password = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->nid = '';
        $this->phone = '';
        $this->gender = '';
        $this->dob = '';
        $this->idroles = [];
    }

    public function store()
    {
        
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->id,
            //'password' => 'required|min:6',
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => 'required|string|max:10',
            'profile.phone' => 'required|string|max:10',
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
            'status' => $this->profile['status'],
            'user_register' => auth()->user()->id,
        ]);

        $user = User::updateOrCreate(['id' => $this->id], [
            'email' => $this->email,
            //'password' => bcrypt($this->password),
            //'status' => $this->status,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);


        $roles = Role::whereIn('id',  $this->idroles)->get();
        $user->syncRoles($roles);


        session()->flash('message',
            $this->id ? 'Usuario actualizado exitosamente.' : 'Usuario creado exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::with('profile', 'roles')->findOrFail($id);

        $this->id = $id;
        $this->profile = $user->profile->toArray();
        $this->email = $user->email;
        //$this->password = $user->password;
        $this->idroles = $user->roles->pluck('id')->toArray();

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }
}

