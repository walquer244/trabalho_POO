<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Redirecionar raiz para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Formulário de login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Processar login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ], [
        'email.required' => 'O campo e-mail é obrigatório.',
        'email.email' => 'Insira um e-mail válido.',
        'password.required' => 'O campo senha é obrigatório.',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->onlyInput('email');
});

// Processar logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

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
});