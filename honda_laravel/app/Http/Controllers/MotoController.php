<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moto;

class MotoController extends Controller
{
    public function index(Request $request)
    {
        $success = $request->query('success', '');
        $error   = $request->query('error', '');

        try {
            $motos = Moto::orderBy('id', 'desc')->get();
            return view('motos.list', compact('motos', 'success', 'error'));
        } catch (\Exception $e) {
            die("Erro ao carregar motos: " . $e->getMessage());
        }
    }

    public function create()
    {
        return view('motos.create');
    }

    public function store(Request $request)
    {
        $marca  = trim($request->input('marca', ''));
        $modelo = trim($request->input('modelo', ''));
        $cor    = trim($request->input('cor', ''));
        $ano    = (int)$request->input('ano', 0);
        $valor  = str_replace(',', '.', trim($request->input('valor', '')));

        if (empty($marca) || empty($modelo) || empty($cor) || empty($ano) || !$request->has('valor')) {
            $error = 'Por favor, preencha todos os campos obrigatórios.';
        } elseif ((float)$valor <= 0) {
            $error = 'O valor da moto deve ser maior que zero.';
        } elseif ($ano < 1900 || $ano > (int)date('Y') + 1) {
            $error = 'Ano de fabricação inválido.';
        } else {
            try {
                Moto::create([
                    'marca'  => $marca,
                    'modelo' => $modelo,
                    'cor'    => $cor,
                    'ano'    => $ano,
                    'valor'  => (float)$valor,
                ]);
                return redirect('/motos/list.php?success=' . urlencode("Moto cadastrada com sucesso!"));
            } catch (\Exception $e) {
                $error = "Erro ao salvar: " . $e->getMessage();
            }
        }

        return view('motos.create', compact('error', 'marca', 'modelo', 'cor', 'ano', 'valor'));
    }

    public function edit(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/motos/list.php');
        }

        $moto = Moto::find($id);
        if (!$moto) {
            return redirect('/motos/list.php?error=' . urlencode("Moto não encontrada."));
        }

        return view('motos.edit', compact('moto', 'id'));
    }

    public function update(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/motos/list.php');
        }

        $moto = Moto::find($id);
        if (!$moto) {
            return redirect('/motos/list.php?error=' . urlencode("Moto não encontrada."));
        }

        $marca  = trim($request->input('marca', ''));
        $modelo = trim($request->input('modelo', ''));
        $cor    = trim($request->input('cor', ''));
        $ano    = (int)$request->input('ano', 0);
        $valor  = str_replace(',', '.', trim($request->input('valor', '')));

        if (empty($marca) || empty($modelo) || empty($cor) || empty($ano) || !$request->has('valor')) {
            $error = 'Por favor, preencha todos os campos obrigatórios.';
        } elseif ((float)$valor <= 0) {
            $error = 'O valor deve ser maior que zero.';
        } elseif ($ano < 1900 || $ano > (int)date('Y') + 1) {
            $error = 'Ano de fabricação inválido.';
        } else {
            try {
                $moto->update([
                    'marca'  => $marca,
                    'modelo' => $modelo,
                    'cor'    => $cor,
                    'ano'    => $ano,
                    'valor'  => (float)$valor,
                ]);
                return redirect('/motos/list.php?success=' . urlencode("Moto atualizada com sucesso!"));
            } catch (\Exception $e) {
                $error = "Erro ao atualizar: " . $e->getMessage();
            }
        }

        return view('motos.edit', compact('moto', 'id', 'error'));
    }

    public function destroy(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/motos/list.php');
        }

        try {
            $moto = Moto::find($id);
            if ($moto) {
                $moto->delete();
                return redirect('/motos/list.php?success=' . urlencode("Moto excluída com sucesso."));
            }
            return redirect('/motos/list.php?error=' . urlencode("Moto não encontrada."));
        } catch (\Exception $e) {
            return redirect('/motos/list.php?error=' . urlencode("Erro ao excluir: " . $e->getMessage()));
        }
    }
}
