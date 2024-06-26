<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:13'],
            'telefono' => ['required', 'string', 'max:10'],
            'sexo' => ['required', 'string', 'in:M,F'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                //'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        // Update the related Persona entity
        $user->persona()->update([
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'cedula' => $input['cedula'],
            'telefono' => $input['telefono'],
            'sexo' => $input['sexo'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'estado' => 1,
            'usuario_modificacion' => $user->id
        ]);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        // Update the related Persona entity
        $user->persona()->update([
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'cedula' => $input['cedula'],
            'telefono' => $input['telefono'],
            'sexo' => $input['sexo'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'estado' => 1,
            'usuario_modificacion' => $user->id
        ]);

        $user->sendEmailVerificationNotification();
    }
}
