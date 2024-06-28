<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->getRoleNames(); // Obtiene una colección de los nombres de los roles

        return view('livewire.user-management', compact('user', 'roles'));
    }
}
