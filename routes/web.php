<?php

use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SpecialtyController;
use App\Livewire\PatientManagement;
use App\Http\Controllers\EmployeeController;

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
    Route::get('/patients', PatientManagement::class)->name('patients');
    Route::resource('employees', EmployeeController::class);
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
