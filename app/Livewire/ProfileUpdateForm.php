<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ProfileUpdateForm extends Component
{
    use WithFileUploads;

    public $state = [];
    public $profile_photo;

    public function mount()
    {
        $user = Auth::user();
        $this->state = array_merge($user->toArray(), $user->persona->toArray());
    }

    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $user = Auth::user();

        Validator::make($this->state, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:13'],
            'telefono' => ['required', 'string', 'max:10'],
            'sexo' => ['required', 'string', 'in:M,F'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();

        $updater->update($user, $this->state);

        $user->persona->update([
            'nombres' => $this->state['nombres'],
            'apellidos' => $this->state['apellidos'],
            'cedula' => $this->state['cedula'],
            'telefono' => $this->state['telefono'],
            'sexo' => $this->state['sexo'],
            'fecha_nacimiento' => $this->state['fecha_nacimiento'],
        ]);

        $this->dispatch('saved');
    }
    protected function updateVerifiedProfileInformation(UpdateUserProfileInformation $updater)
    {
        $user = Auth::user();

        Validator::make($this->state, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:13'],
            'telefono' => ['required', 'string', 'max:10'],
            'sexo' => ['required', 'string', 'in:M,F'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();

        $updater->updateVerifiedUser($user, $this->state);

        $user->persona->update([
            'nombres' => $this->state['nombres'],
            'apellidos' => $this->state['apellidos'],
            'cedula' => $this->state['cedula'],
            'telefono' => $this->state['telefono'],
            'sexo' => $this->state['sexo'],
            'fecha_nacimiento' => $this->state['fecha_nacimiento'],
        ]);

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.profile-update-form');
    }
}
