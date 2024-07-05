<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\UserController;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserManagement extends Component
{
    use WithPagination;

    public $profile, $name, $email, $password, $idroles, $id;
    protected $userService;
    protected $userController;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->userService = app(UserService::class);
        $this->userController = app(UserController::class);
    }

    public function render()
    {
        $users = $this->userService->getAllUsers();
        $roles = $this->userService->getAllRoles();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $this->resetInputFields();
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
        $request = new UserRequest();
        $request->replace([
            'email' => $this->email,
            'profile' => $this->profile,
            'idroles' => $this->idroles,
        ]);

        $this->userController->store($request);

        session()->flash('message', $this->id ? 'Usuario actualizado exitosamente.' : 'Usuario creado exitosamente.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        $this->id = $id;
        $this->profile = $user->profile->toArray();
        $this->email = $user->email;
        $this->idroles = $user->roles->pluck('id')->toArray();
    }

    public function delete($id)
    {
        $this->userController->destroy($id);
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }
}

