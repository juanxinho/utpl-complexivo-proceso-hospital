<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Livewire\UserManagement;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/usuarios', UserManagement::class)->name('usuarios');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
