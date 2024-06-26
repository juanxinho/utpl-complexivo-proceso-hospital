<?php

use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/translations', function () {
    return view('vendor.translation-manager.index');
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
