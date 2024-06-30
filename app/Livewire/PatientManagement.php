<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class PatientManagement extends Component
{
    use WithPagination;

    public $email, $password, $nombres, $apellidos, $cedula, $telefono, $sexo, $fecha_nacimiento;
    public $patientId;
    public $isOpen = false;

    /*protected $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'cedula' => ['required', 'string', 'max:10', new \App\Rules\EcuadorianCedulaOrRuc],
        'telefono' => ['required', 'string', new \App\Rules\EcuadorianPhone],
        'sexo' => 'required|string|in:M,F',
        'fecha_nacimiento' => 'required|date',
    ];
*/
    public function render()
    {
        return view('pacientes.index', [
            'patients' => User::with('persona')->role('patient')->paginate(10),
        ])->layout('layouts.app');
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
    }

    public function store()
    {
        $validatedData = $this->validate();

        $persona = Persona::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'idpersona' => $persona->idpersona,
        ]);

        $user->assignRole('patient');

        session()->flash('message', 'Paciente creado exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $patient = User::findOrFail($id);
        $this->patientId = $id;
        $this->email = $patient->email;
        $this->password = '';
        $this->nombres = $patient->persona->nombres;
        $this->apellidos = $patient->persona->apellidos;
        $this->cedula = $patient->persona->cedula;
        $this->telefono = $patient->persona->telefono;
        $this->sexo = $patient->persona->sexo;
        $this->fecha_nacimiento = $patient->persona->fecha_nacimiento;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Paciente eliminado exitosamente.');
    }
}
