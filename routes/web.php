<?php

use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EspecialidadController;

// Rutas públicas
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/translations', function () {
    return view('vendor.translation-manager.index');
})->name('translations');

Route::view('/help', 'help')->name('help');

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas protegidas para roles específicos
Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('/users', UserManagement::class)->name('users');
});

// Rutas protegidas por autenticación (menos restrictivas)
Route::middleware(['auth'])->group(function () {
    Route::resource('citas', CitaController::class);
    Route::get('medico/citas', [CitaController::class, 'medicoIndex'])->name('medico.citas.index');
    Route::resource('especialidades', EspecialidadController::class);
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
