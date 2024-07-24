<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    /**
     * Retrieve all users with their roles and profiles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return User::with('roles', 'profile')->get();
    }

    /**
     * Retrieve a user by their ID with roles and profile.
     *
     * @param int $id
     * @return \App\Models\User
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getUserById($id)
    {
        return User::with('roles', 'profile')->findOrFail($id);
    }

    /**
     * Retrieve all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return Role::all();
    }

    /**
     * Create a new user along with their profile and assign roles.
     *
     * @param array $data
     * @return \App\Models\User
     */
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

    /**
     * Update an existing user along with their profile and roles.
     *
     * @param \App\Models\User $user
     * @param array $data
     * @return \App\Models\User
     */
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

    /**
     * Delete a user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function deleteUser(User $user)
    {
        $user->delete();
    }
}
