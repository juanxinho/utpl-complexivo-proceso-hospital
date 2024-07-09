<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'phone' => ['required', 'string', new EcuadorPhone],
            'gender' => ['required', 'string', 'in:M,F'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $profile = Profile::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'nid' => $input['nid'],
            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'dob' => $input['dob'],
            'country_id' => $input['country_id'],
            'state_id' => $input['state_id'],
            'city_id' => $input['city_id'],
            'address' => $input['address'],
        ]);

        $user = User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status' => 1,
            'user_register' => 1,
            'id_profile' => $profile->id_profile,
        ]);

        $defaultRole = Role::firstOrCreate(['name' => 'patient']);
        $user->assignRole($defaultRole);

        return $user;
    }
}
