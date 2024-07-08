<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DashboardController;
use App\Livewire\MedicManagement;
use App\Livewire\PatientManagement;
use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use App\Livewire\ScheduleAppointment;

// Rutas públicas
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/translations', function () {
    return view('vendor.translation-manager.index');
})->name('translations');

Route::view('/help', 'help')->name('help');
Route::view('/translation-manager', 'translation-manager')->name('translation-manager');

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/patients', PatientManagement::class)->name('patients');
    //Route::get('medics', MedicManagement::class)->name('medics');

    Route::get('admin/medics', MedicManagement::class)->name('admin.medics.index');
    Route::post('admin/medics', [UserController::class, 'store'])->name('medics.store');
    Route::patch('admin/medics/{medic}', [UserController::class, 'update'])->name('medics.update');
    Route::delete('admin/medics/{medic}', [UserController::class, 'destroy'])->name('medics.destroy');
});

// Rutas protegidas para roles específicos
Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    //Route::resource('/admin/users/roles', RoleController::class);
    Route::get('/admin/users', UserManagement::class)->name('users');
});

// Rutas protegidas por autenticación (menos restrictivas)
Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    Route::resource('admin/appointments', AppointmentController::class)->names([
        'index' => 'admin.appointments.index',
        'create' => 'admin.appointments.create',
        'store' => 'admin.appointments.store',
        'show' => 'admin.appointments.show',
        'edit' => 'admin.appointments.edit',
        'update' => 'admin.appointments.update',
        'destroy' => 'admin.appointments.destroy',
        'patientAppointments' => 'admin.appointments.patient_appointments',
    ]);
    Route::resource('admin/users/roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy',
    ]);
    Route::resource('admin/medics/specialties', SpecialtyController::class)->names([
        'index' => 'admin.specialties.index',
        'create' => 'admin.specialties.create',
        'store' => 'admin.specialties.store',
        'show' => 'admin.specialties.show',
        'edit' => 'admin.specialties.edit',
        'update' => 'admin.specialties.update',
        'destroy' => 'admin.specialties.destroy',
    ]);
    Route::get('medic/appointments', [AppointmentController::class, 'medicIndex'])->name('medic.appointments.index');
});

Route::middleware(['auth', 'role:patient|admin|super-admin'])->group(function () {
    Route::get('patient/appointments/create', ScheduleAppointment::class)->name('front.patient.appointments.create');
    //Route::get('/dashboard', [App\Http\Controllers\PatientController::class, 'dashboard'])->name('dashboard');
    Route::get('patient/appointments/{id}', [AppointmentController::class, 'show'])->name('front.patient.appointments.show');
    Route::get('patient/appointments/history', [AppointmentController::class, 'history'])->name('front.patient.appointments.history');
    //Route::get('/results', [App\Http\Controllers\ResultController::class, 'index'])->name('results.index');
    //Route::get('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'index'])->name('prescriptions.index');
    //Route::get('/treatments', [App\Http\Controllers\TreatmentController::class, 'index'])->name('treatments.index');
});
