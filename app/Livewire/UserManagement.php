<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserManagement extends Component
{
    use WithPagination;

    public $users, $roles, $persona, $name, $email, $password, $idusuario, $idroles, $id;
    public $isOpen = 0;
    /*protected $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'cedula' => ['required', 'string', 'max:10', new \App\Rules\EcuadorCedulaOrRuc],
        'telefono' => ['required', 'string', new \App\Rules\EcuadorPhone],
        'sexo' => 'required|string|in:M,F',
        'fecha_nacimiento' => 'required|date',
    ];*/

    public function render()
    {
        $this->users = User::with('roles', 'persona')->get();
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
        $this->nombres = '';
        $this->apellidos = '';
        $this->cedula = '';
        $this->telefono = '';
        $this->sexo = '';
        $this->fecha_nacimiento = '';
        $this->idroles = [];
    }

    public function store()
    {
        //$validatedData = $this->validate();

        $persona = Persona::updateOrCreate(['idpersona' => $this->id], [
            'nombres' => $this->persona['nombres'],
            'apellidos' => $this->persona['apellidos'],
            'cedula' => $this->persona['cedula'],
            'telefono' => $this->persona['telefono'],
            'sexo' => $this->persona['sexo'],
            'fecha_nacimiento' => $this->persona['fecha_nacimiento'],
            'estado' => $this->persona['estado'],
            'usuario_registro' => auth()->user()->id,
        ]);

        $usuario = User::updateOrCreate(['id' => $this->id], [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'estado' => $this->persona['estado'],
            'idpersona' => $persona->idpersona,
            'usuario_registro' => auth()->user()->id,
        ]);
        //var_dump($this->idroles);die;
        foreach ($this->idroles as $roleId) {
            $role = Role::findById($roleId);
var_dump($role);die;
            if ($role) {
                $usuario->assignRole($role);
            }
        }

        session()->flash('message',
            $this->id ? 'Usuario actualizado exitosamente.' : 'Usuario creado exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $usuario = User::with('persona', 'roles')->findOrFail($id);
        $this->id = $id;
        $this->persona = $usuario->persona->toArray();
        $this->email = $usuario->email;
        $this->password = '';
        $this->idroles = $usuario->roles->pluck('id')->toArray();

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }
}

