<?php
 
namespace App\Http\Controllers;
 
use App\Models\Produto;
use App\Models\Funcionario;
use App\Models\Cliente;
 
class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos    = Produto::count();
        $totalFuncionarios = Funcionario::count();
        $totalClientes    = Cliente::count();
 
        return view('dashboard.index', compact(
            'totalProdutos',
            'totalFuncionarios',
            'totalClientes'
        ));
    }
}