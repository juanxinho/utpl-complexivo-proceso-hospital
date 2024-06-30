<?php

namespace App\Actions\Fortify;

use App\Models\Persona;
use App\Models\User;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'telefono' => ['required', 'string', new EcuadorPhone],
            'sexo' => ['required', 'string', 'in:M,F'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $persona = Persona::create([
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'cedula' => $input['cedula'],
            'telefono' => $input['telefono'],
            'sexo' => $input['sexo'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'estado' => 1,
        ]);

        $user = User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'estado' => 1,
            'usuario_registro' => 1,
            'idpersona' => $persona->idpersona,
        ]);

        $defaultRole = Role::firstOrCreate(['name' => 'patient']);
        $user->assignRole($defaultRole);

        return $user;
    }
}
