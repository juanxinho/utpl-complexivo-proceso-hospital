<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    public function getAllUsers()
    {
        return User::with('roles', 'profile')->get();
    }

    public function getUserById($id)
    {
        return User::with('roles', 'profile')->findOrFail($id);
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function createUser(array $data)
    {
        $profile = Profile::create($data['profile']);

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_profile' => $profile->id,
            'status' => 1,
            'user_register' => auth()->user()->id,
        ]);

        $user->syncRoles($data['roles']);

        return $user;
    }

    public function updateUser(User $user, array $data)
    {
        $user->profile->update($data['profile']);
        $user->update(['email' => $data['email']]);

        if (isset($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        $user->syncRoles($data['roles']);

        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function assignSpecialties($userId, $specialties)
    {
        $user = User::findOrFail($userId);
        $user->specialties()->sync($specialties);

        return $user;
    }
}
