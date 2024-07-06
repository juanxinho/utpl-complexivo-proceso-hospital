<?php

namespace App\Livewire;

use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
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

    public $profile, $name, $email, $password, $roles, $idroles, $id, $searchRoles, $selectedRole;
    public $isOpen = false;
    public $isOpenEdit = false;
    public $searchTerm = '';


    public function mount()
    {
        $this->searchRoles = Role::pluck('name', 'name');
        $this->roles = Role::all();
    }
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $users = User::with('profile')
            ->when($this->selectedRole, function ($query) {
                $query->role($this->selectedRole);
            })
            ->where(function($query) use ($searchTerm) {
                $query->where('email', 'like', $searchTerm)
                    ->orWhereHas('profile', function($query) use ($searchTerm) {
                        $query->where('first_name', 'like', $searchTerm)
                            ->orWhere('last_name', 'like', $searchTerm);
                    });
            })
            ->paginate(10);

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'))->layout('layouts.app');
    }

    public function updatedSelectedRole() {
        $this->render();
    }

    public function updatedSsearchTerm() {
        $this->render();
    }

    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->selectedRole = '';
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

    public function openModalEdit()
    {
        $this->isOpenEdit = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenEdit = false;
    }

    private function resetInputFields()
    {
        $this->email = '';
        $this->password = '';
        $this->profile['first_name'] = '';
        $this->profile['last_name'] = '';
        $this->profile['nid'] = '';
        $this->profile['phone'] = '';
        $this->profile['gender'] = '';
        $this->profile['dob'] = null;
        $this->idroles = [];
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

        $this->openModalEdit();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }
}

