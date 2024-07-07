<?php

namespace App\Livewire;

use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class PatientManagement extends Component
{
    use WithPagination;

    public $email, $password, $first_name, $last_name, $nid, $phone, $gender, $dob;
    public $patientId;
    public $isOpen = false;

    public function render()
    {
        return view('admin.patients.index', [
            'patients' => User::with('profile')->role('patient')->paginate(10),
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
        $this->first_name = '';
        $this->last_name = '';
        $this->nid = '';
        $this->phone = '';
        $this->gender = '';
        $this->dob = '';
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
        ]);

        $profile = Profile::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'nid' => $this->nid,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'dob' => $this->dob,
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
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
        $this->first_name = $patient->profile->first_name;
        $this->last_name = $patient->profile->last_name;
        $this->nid = $patient->profile->nid;
        $this->phone = $patient->profile->phone;
        $this->gender = $patient->profile->gender;
        $this->dob = $patient->profile->dob;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Paciente eliminado exitosamente.');
    }
}
