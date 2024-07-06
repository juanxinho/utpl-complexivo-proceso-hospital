<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DashboardController;
use App\Livewire\EmployeeManagement;
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

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/patients', PatientManagement::class)->name('patients');
    //Route::get('employees', EmployeeManagement::class)->name('employees');

    Route::get('admin/employees', EmployeeManagement::class)->name('employees.index');
    Route::post('admin/employees', [UserController::class, 'store'])->name('employees.store');
    Route::patch('admin/employees/{employee}', [UserController::class, 'update'])->name('employees.update');
    Route::delete('admin/employees/{employee}', [UserController::class, 'destroy'])->name('employees.destroy');
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
    Route::resource('admin/user/roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy',
    ]);
    //Route::resource('admin/employees', EmployeeController::class);
    //Route::get('admin/employees/assign-specialties/{id}', [EmployeeController::class, 'assignSpecialties'])->name('employees.assign.specialties');
    //Route::post('admin/employees/store-specialties/{id}', [EmployeeController::class, 'storeSpecialties'])->name('employees.store.specialties');
    Route::get('medic/appointments', [AppointmentController::class, 'medicIndex'])->name('medic.appointments.index');
    Route::resource('specialties', SpecialtyController::class);
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
