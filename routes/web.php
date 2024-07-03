<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialtyController;
use App\Livewire\EmployeeManagement;
use App\Livewire\PatientManagement;
use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use App\Livewire\ScheduleAppointmentWizard;

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('patient/appointments/create', ScheduleAppointmentWizard::class)->name('patient.appointments.create');
});
// Rutas públicas
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/translations', function () {
    return view('vendor.translation-manager.index');
})->name('translations');

Route::view('/help', 'help')->name('help');

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('patients', PatientManagement::class)->name('patients');
    //Route::get('employees', EmployeeManagement::class)->name('employees');

    Route::get('/employees', EmployeeManagement::class)->name('employees.index');
    Route::post('/employees', [UserController::class, 'store'])->name('employees.store');
    Route::patch('/employees/{employee}', [UserController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [UserController::class, 'destroy'])->name('employees.destroy');
});

// Rutas protegidas para roles específicos
Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    Route::resource('/users/roles', RoleController::class);
    Route::get('/admin/users', UserManagement::class)->name('users');
});

// Rutas protegidas por autenticación (menos restrictivas)
Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::get('medic/appointments', [AppointmentController::class, 'medicIndex'])->name('medic.appointments.index');
    Route::resource('specialties', SpecialtyController::class);
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    //Route::get('/dashboard', [App\Http\Controllers\PatientController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointments/{id}', [App\Http\Controllers\AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/history', [App\Http\Controllers\AppointmentController::class, 'history'])->name('appointments.history');
    //Route::get('/results', [App\Http\Controllers\ResultController::class, 'index'])->name('results.index');
    //Route::get('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'index'])->name('prescriptions.index');
    //Route::get('/treatments', [App\Http\Controllers\TreatmentController::class, 'index'])->name('treatments.index');
});
