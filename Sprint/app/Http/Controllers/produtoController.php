<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::latest()->paginate(10);
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'               => 'required|string|max:255',
            'valor'              => 'required|numeric|min:0.01',
            'cor'                => 'required|string|max:100',
            'quantidade_estoque' => 'required|integer|min:0',
        ], [
            'nome.required'               => 'O nome é obrigatório.',
            'valor.required'              => 'O valor é obrigatório.',
            'valor.min'                   => 'O valor deve ser maior que zero.',
            'cor.required'                => 'A cor é obrigatória.',
            'quantidade_estoque.required' => 'A quantidade em estoque é obrigatória.',
            'quantidade_estoque.min'      => 'A quantidade em estoque não pode ser negativa.',
        ]);

        Produto::create($validated);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome'               => 'required|string|max:255',
            'valor'              => 'required|numeric|min:0.01',
            'cor'                => 'required|string|max:100',
            'quantidade_estoque' => 'required|integer|min:0',
        ], [
            'nome.required'               => 'O nome é obrigatório.',
            'valor.required'              => 'O valor é obrigatório.',
            'valor.min'                   => 'O valor deve ser maior que zero.',
            'cor.required'                => 'A cor é obrigatória.',
            'quantidade_estoque.required' => 'A quantidade em estoque é obrigatória.',
            'quantidade_estoque.min'      => 'A quantidade em estoque não pode ser negativa.',
        ]);

        $produto->update($validated);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}