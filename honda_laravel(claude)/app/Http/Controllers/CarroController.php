<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function index()
    {
        $carros = Carro::orderByDesc('id')->get();
        return view('carros.list', compact('carros'));
    }

    public function create()
    {
        return view('carros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca'  => 'required|string|max:80',
            'modelo' => 'required|string|max:100',
            'cor'    => 'required|string|max:50',
            'ano'    => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'valor'  => 'required|numeric|min:0.01',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'min'      => 'O valor deve ser maior que zero.',
        ]);

        Carro::create([
            'marca'  => trim($request->marca),
            'modelo' => trim($request->modelo),
            'cor'    => trim($request->cor),
            'ano'    => (int) $request->ano,
            'valor'  => (float) str_replace(',', '.', $request->valor),
        ]);

        return redirect()->route('carros.index')
            ->with('success', 'Carro cadastrado com sucesso!');
    }

    public function edit(Carro $carro)
    {
        return view('carros.edit', compact('carro'));
    }

    public function update(Request $request, Carro $carro)
    {
        $request->validate([
            'marca'  => 'required|string|max:80',
            'modelo' => 'required|string|max:100',
            'cor'    => 'required|string|max:50',
            'ano'    => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'valor'  => 'required|numeric|min:0.01',
        ]);

        $carro->update([
            'marca'  => trim($request->marca),
            'modelo' => trim($request->modelo),
            'cor'    => trim($request->cor),
            'ano'    => (int) $request->ano,
            'valor'  => (float) str_replace(',', '.', $request->valor),
        ]);

        return redirect()->route('carros.index')
            ->with('success', 'Carro atualizado com sucesso!');
    }

    public function destroy(Carro $carro)
    {
        $carro->delete();
        return redirect()->route('carros.index')
            ->with('success', 'Carro excluído com sucesso.');
    }
}
