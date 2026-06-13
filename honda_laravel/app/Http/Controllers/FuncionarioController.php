<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        $success = $request->query('success', '');
        $error   = $request->query('error', '');

        try {
            $funcionarios = Funcionario::orderBy('id', 'desc')->get();
            $totalFuncionarios = $funcionarios->count();
            $folhaSalarial = $funcionarios->sum('salario');
            $mediaSalarial = $funcionarios->avg('salario') ?: 0.0;

            return view('funcionarios.list', compact('funcionarios', 'success', 'error', 'totalFuncionarios', 'folhaSalarial', 'mediaSalarial'));
        } catch (\Exception $e) {
            die("Erro ao carregar funcionários: " . $e->getMessage());
        }
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $nome            = trim($request->input('nome', ''));
        $funcao          = trim($request->input('funcao', ''));
        $data_admissao   = $request->input('data_admissao', '');
        $data_nascimento = $request->input('data_nascimento', '');
        $salario         = (float)$request->input('salario', 0);

        if (empty($nome) || empty($funcao) || empty($data_admissao) || empty($data_nascimento) || !$request->has('salario')) {
            $error = "Por favor, preencha todos os campos obrigatórios.";
        } elseif ($salario <= 0) {
            $error = "O salário deve ser um valor maior que zero.";
        } elseif (strtotime($data_admissao) < strtotime($data_nascimento)) {
            $error = "A data de admissão não pode ser anterior à data de nascimento.";
        } else {
            try {
                Funcionario::create([
                    'nome'            => $nome,
                    'funcao'          => $funcao,
                    'data_admissao'   => $data_admissao,
                    'data_nascimento' => $data_nascimento,
                    'salario'         => $salario
                ]);
                return redirect('/funcionarios/list.php?success=' . urlencode("Funcionário cadastrado com sucesso."));
            } catch (\Exception $e) {
                $error = "Erro ao cadastrar funcionário: " . $e->getMessage();
            }
        }

        return view('funcionarios.create', compact('error', 'nome', 'funcao', 'data_admissao', 'data_nascimento', 'salario'));
    }

    public function edit(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/funcionarios/list.php');
        }

        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return redirect('/funcionarios/list.php?error=' . urlencode("Funcionário não encontrado."));
        }

        return view('funcionarios.edit', compact('funcionario', 'id'));
    }

    public function update(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/funcionarios/list.php');
        }

        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return redirect('/funcionarios/list.php?error=' . urlencode("Funcionário não encontrado."));
        }

        $nome            = trim($request->input('nome', ''));
        $funcao          = trim($request->input('funcao', ''));
        $data_admissao   = $request->input('data_admissao', '');
        $data_nascimento = $request->input('data_nascimento', '');
        $salario         = (float)$request->input('salario', 0);

        if (empty($nome) || empty($funcao) || empty($data_admissao) || empty($data_nascimento) || !$request->has('salario')) {
            $error = "Por favor, preencha todos os campos obrigatórios.";
        } elseif ($salario <= 0) {
            $error = "O salário deve ser um valor maior que zero.";
        } elseif (strtotime($data_admissao) < strtotime($data_nascimento)) {
            $error = "A data de admissão não pode ser anterior à data de nascimento.";
        } else {
            try {
                $funcionario->update([
                    'nome'            => $nome,
                    'funcao'          => $funcao,
                    'data_admissao'   => $data_admissao,
                    'data_nascimento' => $data_nascimento,
                    'salario'         => $salario
                ]);
                return redirect('/funcionarios/list.php?success=' . urlencode("Funcionário atualizado com sucesso."));
            } catch (\Exception $e) {
                $error = "Erro ao atualizar funcionário: " . $e->getMessage();
            }
        }

        return view('funcionarios.edit', compact('funcionario', 'id', 'error'));
    }

    public function destroy(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/funcionarios/list.php');
        }

        try {
            $funcionario = Funcionario::find($id);
            if ($funcionario) {
                $funcionario->delete();
                return redirect('/funcionarios/list.php?success=' . urlencode("Funcionário excluído com sucesso."));
            }
            return redirect('/funcionarios/list.php?error=' . urlencode("Funcionário não encontrado."));
        } catch (\Exception $e) {
            return redirect('/funcionarios/list.php?error=' . urlencode("Erro ao excluir: " . $e->getMessage()));
        }
    }
}
