<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $numCarros       = DB::table('carros')->count();
        $numMotos        = DB::table('motos')->count();
        $numFuncionarios = DB::table('funcionarios')->count();
        $numUsuarios     = DB::table('usuarios')->count();
        $valCarros       = DB::table('carros')->sum('valor') ?? 0;
        $valMotos        = DB::table('motos')->sum('valor') ?? 0;
        $valTotal        = (float)$valCarros + (float)$valMotos;
        $recentCarros    = DB::table('carros')->orderByDesc('id')->limit(4)->get();
        $recentMotos     = DB::table('motos')->orderByDesc('id')->limit(4)->get();

        return view('dashboard', compact(
            'numCarros', 'numMotos', 'numFuncionarios', 'numUsuarios',
            'valCarros', 'valMotos', 'valTotal', 'recentCarros', 'recentMotos'
        ));
    }
}
