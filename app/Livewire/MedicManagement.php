<?php

namespace App\Livewire;

use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\UserController;

class MedicManagement extends Component
{
    use WithPagination;

    public $medic, $profile, $email, $password, $roles, $id_specialties, $specialties, $searchSpecialties, $selectedSpecialties = [], $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';


    public function mount()
    {
        $this->searchSpecialties = Specialty::pluck('name', 'id_specialty');
        $this->specialties = Specialty::where('status', 1)->get();
    }
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $medics = User::with('profile')
            ->when(!empty($this->selectedSpecialties), function ($query) {
                $query->whereHas('specialties', function ($query) {
                    $query->whereIn('specialty.id_specialty', (array) $this->selectedSpecialties);
                });
            })
            ->where(function($query) use ($searchTerm) {
                $query->where('email', 'like', $searchTerm)
                    ->orWhereHas('profile', function($query) use ($searchTerm) {
                        $query->where('first_name', 'like', $searchTerm)
                            ->orWhere('last_name', 'like', $searchTerm);
                    });
            })
            ->role('medic')
            ->paginate(10);

        $specialties = Specialty::all();

        return view('admin.medics.index', compact('medics', 'specialties'))->layout('layouts.app');
    }

    public function updatedSelectedSpecialty() {
        $this->render();
    }

    public function updatedSearchTerm() {
        $this->render();
    }

    public function clearFilters()
    {
        $this->searchTerm = '';
    }

    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    private function resetInputFields()
    {
        $this->email = '';
        $this->profile['first_name'] = '';
        $this->profile['last_name'] = '';
        $this->profile['nid'] = '';
        $this->profile['phone'] = '';
        $this->profile['gender'] = '';
        $this->profile['dob'] = null;
        $this->id_specialties = [];
        $this->selectedSpecialties = [];
    }

    public function create()
    {
        $this->resetInputFields();
        $this->roles = Role::where('name', 'medic')->get();
        $this->isOpenCreate = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->id,
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => ['required', 'string', 'max:13', new EcuadorCedulaOrRuc],
            'profile.phone' => ['required', 'string', 'max:10', new EcuadorPhone],
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
            'id_specialties' => 'required|array|min:1',
        ]);

        $profile = Profile::updateOrCreate(['id_profile' => $this->id], [
            'first_name' => $this->profile['first_name'],
            'last_name' => $this->profile['last_name'],
            'nid' => $this->profile['nid'],
            'phone' => $this->profile['phone'],
            'gender' => $this->profile['gender'],
            'dob' => $this->profile['dob'],
            'user_register' => auth()->user()->id,
        ]);

        $user = User::updateOrCreate(['id' => $this->id], [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);


        $roles = Role::where('name', 'medic')->get();
        $user->syncRoles($roles);

        $user->specialties()->sync($this->id_specialties);

        session()->flash('message',
            $this->id ? __('Medic successfully updated.') : __('Medic successfully created.'));

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $medic = User::with('profile', 'roles', 'specialties')->findOrFail($id);
        $this->id = $id;
        $this->profile = $medic->profile->toArray();
        $this->email = $medic->email;
        $this->roles = Role::where('name', 'medic')->get();
        $this->id_specialties = $medic->specialties()->pluck('specialty.id_specialty')->toArray();
        $this->isOpenEdit = true;
    }

    public function destroy(User $medic)
    {
        app(UserController::class)->destroy($medic);
    }
}
