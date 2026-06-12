<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::orderByDesc('id')->get();
        return view('funcionarios.list', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'            => 'required|string|max:100',
            'funcao'          => 'required|string|max:100',
            'data_admissao'   => 'required|date',
            'data_nascimento' => 'required|date',
            'salario'         => 'required|numeric|min:0.01',
        ]);

        Funcionario::create($request->only(
            'nome', 'funcao', 'data_admissao', 'data_nascimento', 'salario'
        ));

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function edit(Funcionario $funcionario)
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $request->validate([
            'nome'            => 'required|string|max:100',
            'funcao'          => 'required|string|max:100',
            'data_admissao'   => 'required|date',
            'data_nascimento' => 'required|date',
            'salario'         => 'required|numeric|min:0.01',
        ]);

        $funcionario->update($request->only(
            'nome', 'funcao', 'data_admissao', 'data_nascimento', 'salario'
        ));

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário excluído com sucesso.');
    }
}
