<?php

use App\Livewire\RoomManagement;
use App\Livewire\MedicSpecialtySchedule;
use App\Livewire\MedicSpecialtyScheduleList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentPatientController;
use App\Http\Controllers\AppointmentMedicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DiagnosticsController;
use App\Livewire\MedicManagement;
use App\Livewire\PatientManagement;
use App\Livewire\UserManagement;
use App\Livewire\ScheduleAppointmentCreate;
use App\Livewire\ScheduleAppointmentEdit;
use App\Livewire\PatientHistory;
use App\Livewire\AttendPatient;
use App\Livewire\MedicsRooms;

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
    Route::resource('admin/specialties', SpecialtyController::class)->names([
        'index' => 'admin.specialties.index',
        'create' => 'admin.specialties.create',
        'store' => 'admin.specialties.store',
        'show' => 'admin.specialties.show',
        'edit' => 'admin.specialties.edit',
        'update' => 'admin.specialties.update',
        'destroy' => 'admin.specialties.destroy',
    ]);
    Route::resource('admin/schedules', ScheduleController::class)->names([
        'index' => 'admin.schedules.index',
        'create' => 'admin.schedules.create',
        'store' => 'admin.schedules.store',
        'show' => 'admin.schedules.show',
        'edit' => 'admin.schedules.edit',
        'update' => 'admin.schedules.update',
        'destroy' => 'admin.schedules.destroy',
    ]);
    Route::resource('admin/invoices', InvoiceController::class)->names([
        'index' => 'admin.invoices.index',
        'create' => 'admin.invoices.create',
        'store' => 'admin.invoices.store',
        'show' => 'admin.invoices.show',
        'edit' => 'admin.invoices.edit',
        'update' => 'admin.invoices.update',
        'destroy' => 'admin.invoices.destroy',
    ]);
    Route::resource('admin/stocks', StockController::class)->names([
        'index' => 'admin.stocks.index',
        'create' => 'admin.stocks.create',
        'store' => 'admin.stocks.store',
        'show' => 'admin.stocks.show',
        'edit' => 'admin.stocks.edit',
        'update' => 'admin.stocks.update',
        'destroy' => 'admin.stocks.destroy',
    ]);
    Route::resource('admin/diagnostics', DiagnosticsController::class)->names([
        'index' => 'admin.diagnostics.index',
        'create' => 'admin.diagnostics.create',
        'store' => 'admin.diagnostics.store',
        'show' => 'admin.diagnostics.show',
        'edit' => 'admin.diagnostics.edit',
        'update' => 'admin.diagnostics.update',
        'destroy' => 'admin.diagnostics.destroy',
    ]);

    Route::get('admin/appointments/edit/{appointmentId}', ScheduleAppointmentEdit::class)->name('admin.appointments.edit');
    Route::get('/admin/medics/manage-specialties-schedules', MedicSpecialtySchedule::class)->name('admin.medics.manage-specialties-schedules');
    Route::get('/admin/medics/specialties-schedules-list', MedicSpecialtyScheduleList::class)->name('admin.medics.manage-specialties-schedules-list');
    Route::get('/admin/medics/assign-rooms', MedicManagement::class)->name('admin.medics.assign-rooms');
    Route::get('/admin/rooms', RoomManagement::class)->name('admin.rooms.index');
    Route::get('/admin/medics/rooms', MedicsRooms::class)->name('admin.medics.rooms.index');
});

Route::middleware(['auth', 'role:patient|admin|super-admin'])->group(function () {
    Route::get('patient/appointments/history', [AppointmentPatientController::class, 'history'])->name('patient.appointments.history');
    Route::get('patient/appointments/next', [AppointmentPatientController::class, 'next'])->name('patient.appointments.next');
    Route::resource('patient/appointments', AppointmentPatientController::class)->names([
        'index' => 'patient.appointments.index',
        'create' => 'patient.appointments.create',
        'store' => 'patient.appointments.store',
        'show' => 'patient.appointments.show',
        'edit' => 'patient.appointments.edit',
        'update' => 'patient.appointments.update',
        'destroy' => 'patient.appointments.destroy',
    ]);
    Route::get('patient/appointments/create', ScheduleAppointmentCreate::class)->name('front.patient.appointments.create');
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
});

Route::middleware(['auth', 'role:medic|admin|super-admin'])->group(function () {
    Route::resource('medic/appointments', AppointmentMedicController::class)->names([
        'index' => 'medic.appointments.index',
        'create' => 'medic.appointments.create',
        'store' => 'medic.appointments.store',
        'show' => 'medic.appointments.show',
        'edit' => 'medic.appointments.edit',
        'update' => 'medic.appointments.update',
        'destroy' => 'medic.appointments.destroy',
    ]);
    Route::get('patient/{id}/history', PatientHistory::class)->name('patient.history');
    Route::get('/attend-patient/{appointmentId}', AttendPatient::class)->name('attend-patient');
});
