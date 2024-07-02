<?php

namespace App\Http\Requests;

use App\Rules\EcuadorPhone;
use App\Rules\EcuadorCedulaOrRuc;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->user,
            'password' => 'required|min:6',
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'profile.phone' => ['required', 'string', 'max:10', new EcuadorPhone],
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
            'roles' => 'required|array|min:1',
        ];
    }
}
