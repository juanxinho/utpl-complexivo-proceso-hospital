<?php

namespace App\Livewire;

use App\Models\Persona;
use App\Models\Rol;
use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public $users, $roles, $persona, $name, $email, $password, $idusuario, $idrol;
    public $isOpen = 0;

    public function render()
    {
        $this->users = User::with('roles', 'persona')->get();
        $this->roles = Rol::all();
        return view('livewire.user-management')->layout('layouts.app');
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
        $this->persona = [];
        //$this->name = '';
        $this->email = '';
        $this->password = '';
        $this->id = '';
        $this->idrol = [];
    }

    public function store()
    {
        $this->validate([
            'persona.nombres' => 'required',
            'persona.apellidos' => 'required',
            'persona.cedula' => 'required|unique:personas,cedula,' . $this->id,
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required|min:6',
            'idrol' => 'required',
        ]);

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
            //'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'estado' => $this->persona['estado'],
            'idpersona' => $persona->idpersona,
            'usuario_registro' => auth()->user()->id,
        ]);

        $usuario->roles()->sync($this->idrol);

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
        //$this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->password = '';
        $this->idrol = $usuario->roles->pluck('idrol')->toArray();

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }
}

