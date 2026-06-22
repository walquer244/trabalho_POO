<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;

// Redirecionar raiz para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas autenticadas
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produtos - acessível por admin e funcionario
    Route::resource('produtos', ProdutoController::class);

    // Clientes - acessível por admin e funcionario
    Route::resource('clientes', ClienteController::class);

    // Funcionários - apenas admin
    Route::resource('funcionarios', FuncionarioController::class)
        ->middleware('admin');

    // Usuários - apenas admin
    Route::resource('users', UserController::class)
        ->middleware('admin');
});

require __DIR__.'/auth.php';