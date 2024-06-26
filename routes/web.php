<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UserManagement;


Route::get('/', function () {
    return view('auth.login');
});

Route::view('/help', 'help')->name('help');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/users', UserManagement::class)->name('users');
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
