<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MiHorarioController;
use App\Http\Controllers\AulaController;


// ======= LOGIN Y DASHBOARD =======

Route::get('/', [LoginController::class, 'index'])->name('login');     // muestra el login
Route::post('/login', [LoginController::class, 'login'])->name('login.post'); // procesa el login
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Página principal del Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');


// ======= DOCENTES =======
Route::middleware(['auth'])->group(function () {
    Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes.index');
    Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes.store');
    Route::get('/docentes/{id}/edit', [DocenteController::class, 'edit'])->name('docentes.edit');
    Route::put('/docentes/{id}', [DocenteController::class, 'update'])->name('docentes.update');
    Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docentes.destroy');
});




// ======= MATERIAS Y GRUPOS =======
Route::get('/materias', [MateriaController::class, 'index'])
    ->middleware(['auth'])
    ->name('materias.index');

Route::get('/materias/create', [MateriaController::class, 'create'])
    ->middleware(['auth'])
    ->name('materias.create');

Route::post('/materias', [MateriaController::class, 'store'])
    ->middleware(['auth'])
    ->name('materias.store');

Route::get('/materias/{materia}/edit', [MateriaController::class, 'edit'])
    ->middleware(['auth'])
    ->name('materias.edit');

Route::put('/materias/{materia}', [MateriaController::class, 'update'])
    ->middleware(['auth'])
    ->name('materias.update');

Route::delete('/materias/{materia}', [MateriaController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('materias.destroy');





// ======= HORARIOS Y AULAS =======
Route::get('/horarios', [App\Http\Controllers\HorarioController::class, 'index'])
    ->middleware(['auth'])
    ->name('horarios.index');

Route::post('/horarios', [App\Http\Controllers\HorarioController::class, 'store'])
    ->middleware(['auth'])
    ->name('horarios.store');

Route::delete('/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('horarios.destroy');


// ======= BITÁCORAS =======
Route::get('/bitacoras', [BitacoraController::class, 'index'])
    ->middleware(['auth'])
    ->name('bitacoras');

// ======= REPORTES =======
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes');


// ======= PERFIL DE USUARIO =======
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

// ======= MIS HORARIOS =======
Route::get('/mis-horarios', [MiHorarioController::class, 'index'])
    ->name('mis-horarios')
    ->middleware('auth');


//asistencias
Route::get('/asistencias', [AsistenciaController::class, 'index'])
    ->middleware(['auth'])
    ->name('asistencias');
    // aulas 
Route::get('/aulas', [AulaController::class, 'index'])->name('aulas.index');