<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\MotoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SetupController;

// ── Autenticação ────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Setup ───────────────────────────────────────────────────────
Route::get('/setup', [SetupController::class, 'run'])->name('setup');

// ── Rotas protegidas ────────────────────────────────────────────
Route::middleware('auth.honda')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Carros  (/carros)
    Route::resource('carros', CarroController::class);

    // Motos  (/motos)
    Route::resource('motos', MotoController::class);

    // Funcionários  (/funcionarios)
    Route::resource('funcionarios', FuncionarioController::class);

    // Usuários – somente admin  (/usuarios)
    Route::middleware('admin.honda')->resource('usuarios', UsuarioController::class);
});
