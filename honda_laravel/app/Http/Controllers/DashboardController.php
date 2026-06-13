<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;
use App\Models\Moto;
use App\Models\Funcionario;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $numCarros       = Carro::count();
            $numMotos        = Moto::count();
            $numFuncionarios = Funcionario::count();
            $numUsuarios     = Usuario::count();
            $valCarros       = Carro::sum('valor');
            $valMotos        = Moto::sum('valor');
            $valTotal        = (float)$valCarros + (float)$valMotos;
            $recentCarros    = Carro::orderBy('id', 'desc')->limit(4)->get();
            $recentMotos     = Moto::orderBy('id', 'desc')->limit(4)->get();

            return view('dashboard', compact(
                'numCarros',
                'numMotos',
                'numFuncionarios',
                'numUsuarios',
                'valCarros',
                'valMotos',
                'valTotal',
                'recentCarros',
                'recentMotos'
            ));
        } catch (\Exception $e) {
            die("<p style='color:red;font-family:sans-serif;padding:20px;'>Erro ao carregar painel: " . $e->getMessage() . "<br>Execute o setup para criar e popular o banco de dados.</p>");
        }
    }
}
