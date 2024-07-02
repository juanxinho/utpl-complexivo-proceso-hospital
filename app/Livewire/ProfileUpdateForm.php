<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;

class ProfileUpdateForm extends Component
{
    public $state = [];

    public function mount()
    {
        $user = Auth::user();
        $this->state = array_merge($user->toArray(), $user->profile->toArray());
    }

    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $user = Auth::user();

        //var_dump($user);die;

        Validator::make($this->state, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'phone' => ['required', 'string', new EcuadorPhone],
            'gender' => ['required', 'string', 'in:M,F'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();

        $updater->update($user, $this->state);

        $user->profile->update([
            'first_name' => $this->state['first_name'],
            'last_name' => $this->state['last_name'],
            'nid' => $this->state['nid'],
            'phone' => $this->state['phone'],
            'gender' => $this->state['gender'],
            'dob' => $this->state['dob'],
        ]);

        $this->dispatch('saved');
    }
    protected function updateVerifiedProfileInformation(UpdateUserProfileInformation $updater)
    {
        $user = Auth::user();

        $updater->updateVerifiedUser($user, $this->state);

        $user->profile->update([
            'first_name' => $this->state['first_name'],
            'last_name' => $this->state['last_name'],
            'nid' => $this->state['nid'],
            'phone' => $this->state['phone'],
            'gender' => $this->state['gender'],
            'dob' => $this->state['dob'],
        ]);

        $this->dispatch('saved');
    }

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile-update-form');
    }
}
