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
    Route::get('/users', UserManagement::class)->name('users');
});

// Rutas protegidas por autenticación (menos restrictivas)
Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::get('medic/appointments', [AppointmentController::class, 'medicIndex'])->name('medic.appointments.index');
    Route::resource('specialties', SpecialtyController::class);
});

/*
Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return 'Admin Page';
        })->name('admin');
    });

    Route::middleware(['permission:edit articles'])->group(function () {
        Route::get('/edit-article', function () {
            return 'Edit Article Page';
        })->name('edit.article');
    });
 * */
