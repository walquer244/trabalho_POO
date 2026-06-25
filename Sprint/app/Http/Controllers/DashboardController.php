<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Produto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::count();
        $totalFuncionarios = Funcionario::count();
        $totalClientes = Cliente::count();

        return view('dashboard.index', compact(
            'totalProdutos',
            'totalFuncionarios',
            'totalClientes'
        ));
    }
}
