<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::orderByDesc('id')->get();
        return view('motos.list', compact('motos'));
    }

    public function create()
    {
        return view('motos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca'  => 'required|string|max:80',
            'modelo' => 'required|string|max:100',
            'cor'    => 'required|string|max:50',
            'ano'    => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'valor'  => 'required|numeric|min:0.01',
        ]);

        Moto::create([
            'marca'  => trim($request->marca),
            'modelo' => trim($request->modelo),
            'cor'    => trim($request->cor),
            'ano'    => (int) $request->ano,
            'valor'  => (float) str_replace(',', '.', $request->valor),
        ]);

        return redirect()->route('motos.index')
            ->with('success', 'Moto cadastrada com sucesso!');
    }

    public function edit(Moto $moto)
    {
        return view('motos.edit', compact('moto'));
    }

    public function update(Request $request, Moto $moto)
    {
        $request->validate([
            'marca'  => 'required|string|max:80',
            'modelo' => 'required|string|max:100',
            'cor'    => 'required|string|max:50',
            'ano'    => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'valor'  => 'required|numeric|min:0.01',
        ]);

        $moto->update([
            'marca'  => trim($request->marca),
            'modelo' => trim($request->modelo),
            'cor'    => trim($request->cor),
            'ano'    => (int) $request->ano,
            'valor'  => (float) str_replace(',', '.', $request->valor),
        ]);

        return redirect()->route('motos.index')
            ->with('success', 'Moto atualizada com sucesso!');
    }

    public function destroy(Moto $moto)
    {
        $moto->delete();
        return redirect()->route('motos.index')
            ->with('success', 'Moto excluída com sucesso.');
    }
}
