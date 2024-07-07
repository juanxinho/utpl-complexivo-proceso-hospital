<?php

namespace App\Livewire;

use App\Rules\EcuadorCedulaOrRuc;
use App\Rules\EcuadorPhone;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;

class PatientManagement extends Component
{
    use WithPagination;

    public $patient, $profile, $email, $password, $first_name, $last_name, $nid, $phone, $gender, $dob,$searchStatuses, $selectedStatus, $id;
    public $isOpenCreate = false;
    public $isOpenEdit = false;
    public $searchTerm = '';

    public function mount()
    {
        $this->searchStatuses = ['0' => 'Inactive', '1' => 'Active'];
    }
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $patients = User::with('profile')
            ->when($this->selectedStatus !== null && $this->selectedStatus !== '', function ($query) {
                $query->where('status', $this->selectedStatus);
            })
            ->where(function($query) use ($searchTerm) {
                $query->where('email', 'like', $searchTerm)
                    ->orWhereHas('profile', function($query) use ($searchTerm) {
                        $query->where('first_name', 'like', $searchTerm)
                            ->orWhere('last_name', 'like', $searchTerm);
                    });
            })
            ->role('patient')
            ->paginate(10);

        return view('admin.patients.index', compact('patients'))->layout('layouts.app');
    }

    public function updatedSelectedStatus() {
        $this->render();
    }

    public function updatedSearchTerm() {
        $this->render();
    }

    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->selectedStatus = null;
    }

    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    private function resetInputFields()
    {
        $this->email = '';
        $this->password = '';
        $this->profile['first_name'] = '';
        $this->profile['last_name'] = '';
        $this->profile['nid'] = '';
        $this->profile['phone'] = '';
        $this->profile['gender'] = '';
        $this->profile['dob'] = null;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpenCreate = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->id,
            'profile.first_name' => 'required|string|max:255',
            'profile.last_name' => 'required|string|max:255',
            'profile.nid' => ['required', 'string', 'max:13', 'unique:profile,nid,' . $this->id . ',id_profile', new EcuadorCedulaOrRuc],
            'profile.phone' => ['required', 'string', 'max:10', new EcuadorPhone],
            'profile.gender' => 'required|string|in:M,F',
            'profile.dob' => 'required|date',
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

        $user = User::updateOrCreate([
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'status' => 1,
            'id_profile' => $profile->id_profile,
            'user_register' => auth()->user()->id,
        ]);

        $user->assignRole('patient');

        session()->flash('message',
            $this->id ? __('Patient successfully updated.') : __('Patient successfully created.'));

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $patient = User::with('profile')->findOrFail($id);

        $this->id = $id;
        $this->profile = $patient->profile->toArray();
        $this->email = $patient->email;
        //$this->password = $user->password;
        $this->isOpenEdit = true;
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 0; // Set status to 0 to mark as inactive
            $user->save(); // Save the change
        }

        session()->flash('message', __('Patient successfully deactivated.'));
    }
}
