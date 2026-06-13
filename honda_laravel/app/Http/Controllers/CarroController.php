<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;

class CarroController extends Controller
{
    public function index(Request $request)
    {
        $success = $request->query('success', '');
        $error   = $request->query('error', '');

        try {
            $carros = Carro::orderBy('id', 'desc')->get();
            return view('carros.list', compact('carros', 'success', 'error'));
        } catch (\Exception $e) {
            die("Erro ao carregar carros: " . $e->getMessage());
        }
    }

    public function create()
    {
        return view('carros.create');
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
            $error = 'O valor do carro deve ser maior que zero.';
        } elseif ($ano < 1900 || $ano > (int)date('Y') + 1) {
            $error = 'Ano de fabricação inválido.';
        } else {
            try {
                Carro::create([
                    'marca'  => $marca,
                    'modelo' => $modelo,
                    'cor'    => $cor,
                    'ano'    => $ano,
                    'valor'  => (float)$valor,
                ]);
                return redirect('/carros/list.php?success=' . urlencode("Carro cadastrado com sucesso!"));
            } catch (\Exception $e) {
                $error = "Erro ao salvar: " . $e->getMessage();
            }
        }

        // Return view with error and old input values
        return view('carros.create', compact('error', 'marca', 'modelo', 'cor', 'ano', 'valor'));
    }

    public function edit(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/carros/list.php');
        }

        $car = Carro::find($id);
        if (!$car) {
            return redirect('/carros/list.php?error=' . urlencode("Carro não encontrado."));
        }

        return view('carros.edit', compact('car', 'id'));
    }

    public function update(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/carros/list.php');
        }

        $car = Carro::find($id);
        if (!$car) {
            return redirect('/carros/list.php?error=' . urlencode("Carro não encontrado."));
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
                $car->update([
                    'marca'  => $marca,
                    'modelo' => $modelo,
                    'cor'    => $cor,
                    'ano'    => $ano,
                    'valor'  => (float)$valor,
                ]);
                return redirect('/carros/list.php?success=' . urlencode("Carro atualizado com sucesso!"));
            } catch (\Exception $e) {
                $error = "Erro ao atualizar: " . $e->getMessage();
            }
        }

        return view('carros.edit', compact('car', 'id', 'error'));
    }

    public function destroy(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/carros/list.php');
        }

        try {
            $car = Carro::find($id);
            if ($car) {
                $car->delete();
                return redirect('/carros/list.php?success=' . urlencode("Carro excluído com sucesso."));
            }
            return redirect('/carros/list.php?error=' . urlencode("Carro não encontrado."));
        } catch (\Exception $e) {
            return redirect('/carros/list.php?error=' . urlencode("Erro ao excluir: " . $e->getMessage()));
        }
    }
}
