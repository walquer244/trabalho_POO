<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::latest()->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'               => 'required|string|max:255',
            'idade'              => 'required|integer|min:1',
            'quantidade_compras' => 'required|integer|min:0',
            'desconto'           => 'required|numeric|min:0|max:100',
        ], [
            'nome.required'               => 'O nome é obrigatório.',
            'idade.required'              => 'A idade é obrigatória.',
            'idade.min'                   => 'A idade deve ser maior que zero.',
            'quantidade_compras.required' => 'A quantidade de compras é obrigatória.',
            'quantidade_compras.min'      => 'A quantidade de compras não pode ser negativa.',
            'desconto.required'           => 'O desconto é obrigatório.',
            'desconto.min'                => 'O desconto não pode ser negativo.',
            'desconto.max'                => 'O desconto não pode ser maior que 100.',
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nome'               => 'required|string|max:255',
            'idade'              => 'required|integer|min:1',
            'quantidade_compras' => 'required|integer|min:0',
            'desconto'           => 'required|numeric|min:0|max:100',
        ], [
            'nome.required'               => 'O nome é obrigatório.',
            'idade.required'              => 'A idade é obrigatória.',
            'idade.min'                   => 'A idade deve ser maior que zero.',
            'quantidade_compras.required' => 'A quantidade de compras é obrigatória.',
            'quantidade_compras.min'      => 'A quantidade de compras não pode ser negativa.',
            'desconto.required'           => 'O desconto é obrigatório.',
            'desconto.min'                => 'O desconto não pode ser negativo.',
            'desconto.max'                => 'O desconto não pode ser maior que 100.',
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}