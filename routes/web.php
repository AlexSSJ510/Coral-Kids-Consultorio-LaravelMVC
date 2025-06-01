<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DoctorController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Panel principal
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas autenticadas
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Pacientes
    Route::resource('pacientes', PacienteController::class);

    // CRUD Doctores
    Route::resource('doctores', DoctorController::class);

    // Citas
    Route::prefix('citas')->group(function () {
        Route::get('/', [CitaController::class, 'index'])->name('citas.index');
        Route::get('/create/{paciente?}', [CitaController::class, 'create'])->name('citas.create');
        Route::post('/', [CitaController::class, 'store'])->name('citas.store');
        Route::post('/{cita}/cambiar-estado', [CitaController::class, 'cambiarEstado'])->name('citas.cambiarEstado');
    });

    Route::get('/historiales', [HistorialMedicoController::class, 'index'])->name('historiales.index');
    Route::get('/historiales/crear/{pacienteId?}', [HistorialMedicoController::class, 'create'])->name('historiales.create');
    Route::post('/historiales', [HistorialMedicoController::class, 'store'])->name('historiales.store');  

    Route::resource('historiales', HistorialMedicoController::class)->parameters([
        'historiales' => 'id'
    ]);
    
    Route::get('/pacientes/{id}/historiales', [HistorialMedicoController::class, 'verHistorialPorPaciente'])->name('historiales.paciente');

});

require __DIR__.'/auth.php';