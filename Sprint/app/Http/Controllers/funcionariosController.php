<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::latest()->paginate(10);
        return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'            => 'required|string|max:255',
            'data_nascimento' => 'required|date|before:today',
            'data_admissao'   => 'required|date',
            'funcao'          => 'required|string|max:255',
            'salario'         => 'required|numeric|min:0.01',
        ], [
            'nome.required'            => 'O nome é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before'   => 'A data de nascimento deve ser anterior a hoje.',
            'data_admissao.required'   => 'A data de admissão é obrigatória.',
            'funcao.required'          => 'A função é obrigatória.',
            'salario.required'         => 'O salário é obrigatório.',
            'salario.min'              => 'O salário deve ser maior que zero.',
        ]);

        Funcionario::create($validated);

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function show(Funcionario $funcionario)
    {
        return view('funcionarios.show', compact('funcionario'));
    }

    public function edit(Funcionario $funcionario)
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $validated = $request->validate([
            'nome'            => 'required|string|max:255',
            'data_nascimento' => 'required|date|before:today',
            'data_admissao'   => 'required|date',
            'funcao'          => 'required|string|max:255',
            'salario'         => 'required|numeric|min:0.01',
        ], [
            'nome.required'            => 'O nome é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before'   => 'A data de nascimento deve ser anterior a hoje.',
            'data_admissao.required'   => 'A data de admissão é obrigatória.',
            'funcao.required'          => 'A função é obrigatória.',
            'salario.required'         => 'O salário é obrigatório.',
            'salario.min'              => 'O salário deve ser maior que zero.',
        ]);

        $funcionario->update($validated);

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário excluído com sucesso!');
    }
}