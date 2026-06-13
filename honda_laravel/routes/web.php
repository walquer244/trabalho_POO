<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\MotoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UsuarioController;

// Public Auth routes
Route::get('/login.php', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login.php', [AuthController::class, 'login']);
Route::get('/logout.php', [AuthController::class, 'logout']);

// Logged-in user routes (Dashboard, Carros, Motos)
Route::middleware(['check_login'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/index.php', [DashboardController::class, 'index']);

    // Carros CRUD
    Route::get('/resources/carros/list.php', [CarroController::class, 'index']);
    Route::get('/resources/carros/create.php', [CarroController::class, 'create']);
    Route::post('/resources/carros/create.php', [CarroController::class, 'store']);
    Route::get('/resources/carros/edit.php', [CarroController::class, 'edit']);
    Route::post('/resources/carros/edit.php', [CarroController::class, 'update']);
    Route::get('/resources/carros/delete.php', [CarroController::class, 'destroy']);

    // Motos CRUD
    Route::get('/motos/list.php', [MotoController::class, 'index']);
    Route::get('/motos/create.php', [MotoController::class, 'create']);
    Route::post('/motos/create.php', [MotoController::class, 'store']);
    Route::get('/motos/edit.php', [MotoController::class, 'edit']);
    Route::post('/motos/edit.php', [MotoController::class, 'update']);
    Route::get('/motos/delete.php', [MotoController::class, 'destroy']);
});

// Admin-only routes (Funcionarios, Usuarios)
Route::middleware(['check_admin'])->group(function () {
    // Funcionarios CRUD
    Route::get('/resources/funcionarios/list.php', [FuncionarioController::class, 'index']);
    Route::get('/resource/funcionarios/create.php', [FuncionarioController::class, 'create']);
    Route::post('/resource/funcionarios/create.php', [FuncionarioController::class, 'store']);
    Route::get('/resource/funcionarios/edit.php', [FuncionarioController::class, 'edit']);
    Route::post('/resource/funcionarios/edit.php', [FuncionarioController::class, 'update']);
    Route::get('/resource/funcionarios/delete.php', [FuncionarioController::class, 'destroy']);

    // Usuarios CRUD
    Route::get('/usuarios/list.php', [UsuarioController::class, 'index']);
    Route::get('/usuarios/create.php', [UsuarioController::class, 'create']);
    Route::post('/usuarios/create.php', [UsuarioController::class, 'store']);
    Route::get('/usuarios/edit.php', [UsuarioController::class, 'edit']);
    Route::post('/usuarios/edit.php', [UsuarioController::class, 'update']);
    Route::get('/usuarios/delete.php', [UsuarioController::class, 'destroy']);
});
