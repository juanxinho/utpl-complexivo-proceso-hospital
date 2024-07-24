<?php

namespace App\Livewire;

use App\Models\MedicSchedule;
use App\Models\Specialty;
use Livewire\Component;
use App\Models\User;
use App\Models\Day;
use App\Models\Schedule;

class MedicSpecialtySchedule extends Component
{
    public $searchSpecialties, $selectedSpecialties = [], $searchStatuses, $selectedStatus;
    public $searchTerm = '';
    public $medics = [];
    public $days;
    public $medic;
    public $id_schedules = [];
    public $specialty;
    public $selectedMedic = null;
    public $specialties = [];
    public $id_other_schedules = [];
    public $schedules = [];
    public $selectedSpecialty = null;
    public $selectedSchedules = [];
    public $medicSpecialties = [];
    public $specialtyDays = [];
    public $specialtySchedules = [];
    public $timeRanges = [];
    public $isOpenCreate = false;
    public $isOpenEdit = false;

    /**
     * Initialize the component.
     *
     * This function is called when the component is mounted and initializes
     * the search specialties, specialties, schedules, and days.
     *
     * @return void
     */
    public function mount()
    {
        $this->searchSpecialties = Specialty::pluck('name', 'id_specialty');
        $this->specialties = Specialty::all();
        $this->schedules = Schedule::all();
        $this->days = Day::orderBy('id')->pluck('name', 'id')->toArray();
    }

    /**
     * Reset the input fields.
     *
     * This function resets all input fields to their default values.
     *
     * @return void
     */
    private function resetInputFields()
    {
        $this->id_other_schedules = [];
        $this->id_schedules = [];
        $this->specialties = [];
        $this->schedules = [];
        $this->timeRanges = [];
        $this->medic = null;
        $this->specialty = null;
    }

    /**
     * Close the modal windows.
     *
     * This function sets the modal windows to be closed.
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isOpenCreate = false;
        $this->isOpenEdit = false;
    }

    /**
     * Assign schedules to the medic.
     *
     * This function validates the data and assigns schedules to the medic for the selected specialty.
     *
     * @return void
     */
    public function assignMedicSchedule()
    {
        MedicSchedule::where('id_specialty', $this->specialty->id_specialty)
            ->where('id_medic', $this->medic->id)
            ->delete();

        foreach ($this->id_schedules as $id_schedule) {
            MedicSchedule::create([
                'id_specialty' => $this->specialty->id_specialty,
                'id_medic' => $this->medic->id,
                'id_schedule' => $id_schedule,
            ]);
        }

        session()->flash('message', 'Schedules updated successfully.');

        $this->resetInputFields();
        $this->closeModal();
    }

    /**
     * Render the component view.
     *
     * This function retrieves and filters the medics based on search term and selected specialties,
     * then returns the view with the medics data.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $medics = User::role('medic')
            ->with(['profile', 'specialties', 'medicSchedules.schedule.day'])
            ->when(!empty($this->selectedSpecialties), function ($query) {
                $query->whereHas('specialties', function ($query) {
                    $query->whereIn('specialty.id_specialty', (array) $this->selectedSpecialties);
                });
            })
            ->where(function($query) use ($searchTerm) {
                $query->orWhereHas('profile', function($query) use ($searchTerm) {
                    $query->where('first_name', 'like', $searchTerm)
                        ->orWhere('last_name', 'like', $searchTerm);
                });
            })
            ->get();

        $dayIds = Schedule::select('day_id')->distinct()->pluck('day_id');
        $this->days = Day::whereIn('id', $dayIds)->orderBy('id')->pluck('name', 'id')->toArray();

        foreach ($medics as $medic) {
            $medicName = $medic->profile->first_name . ' ' . $medic->profile->last_name;
            $specialtySchedules = [];

            foreach ($medic->specialties as $specialty) {
                $specialtyName = $specialty->name;
                $daySchedule = [];

                foreach ($medic->medicSchedules as $medicSchedule) {
                    if ($medicSchedule->id_specialty == $specialty->id_specialty) {
                        if ($medicSchedule->schedule && $medicSchedule->schedule->day) {
                            $dayName = $medicSchedule->schedule->day->name;
                            $timeRange = $medicSchedule->schedule->time_range;
                            $daySchedule[$dayName][$medicSchedule->id_medic_schedule] = $timeRange;
                        }
                    }
                }

                $specialtySchedules[$specialtyName] = [
                    'daySchedule' => $daySchedule,
                    'user_id' => $medic->id,
                    'specialty_id' => $specialty->id_specialty,
                ];
            }

            $this->medics[$medicName] = $specialtySchedules;
        }

        return view('admin.medics.schedules.index', compact('medics'))->layout('layouts.app');
    }

    /**
     * Handle updates to the selected specialty.
     *
     * This function re-renders the component when the selected specialty is updated.
     *
     * @return void
     */
    public function updatedSelectedSpecialty() {
        $this->render();
    }

    /**
     * Handle updates to the search term.
     *
     * This function re-renders the component when the search term is updated.
     *
     * @return void
     */
    public function updatedSearchTerm() {
        $this->render();
    }

    /**
     * Clear all filters.
     *
     * This function resets the search term and selected specialties.
     *
     * @return void
     */
    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->selectedSpecialties = null;
    }

    /**
     * Show the form for editing the schedules of a medic for a specialty.
     *
     * This function retrieves the medic and specialty details and loads the schedules, other schedules, and time ranges.
     *
     * @param int $user_id The ID of the medic.
     * @param int $specialty_id The ID of the specialty.
     * @return void
     */
    public function edit($user_id, $specialty_id)
    {
        $this->medic = User::find($user_id);
        $this->specialty = Specialty::find($specialty_id);
        $this->loadSchedules();
        $this->loadOtherSchedules();
        $this->loadTimeRanges();
        $this->isOpenEdit = true;
    }

    /**
     * Load schedules for the selected specialty and medic.
     *
     * This function retrieves and sets the schedules for the selected specialty and medic.
     *
     * @return void
     */
    public function loadSchedules()
    {
        $this->id_schedules = MedicSchedule::where('id_specialty', $this->specialty->id_specialty)
            ->where('id_medic', $this->medic->id)
            ->get()
            ->pluck('id_schedule')
            ->toArray();
    }

    /**
     * Load other schedules for the medic.
     *
     * This function retrieves and sets the schedules for the medic that are not related to the selected specialty.
     *
     * @return void
     */
    public function loadOtherSchedules()
    {
        $this->id_other_schedules = MedicSchedule::where('id_medic', $this->medic->id)
            ->whereNotIn('id_specialty', [$this->specialty->id_specialty])
            ->get()
            ->pluck('id_schedule')
            ->toArray();
    }

    /**
     * Load time ranges for schedules.
     *
     * This function retrieves and sets the time ranges for all schedules.
     *
     * @return void
     */
    public function loadTimeRanges()
    {
        $this->timeRanges = Schedule::with('day')->get();
    }
}
