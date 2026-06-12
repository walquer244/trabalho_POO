<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderByDesc('id')->get();
        return view('usuarios.list', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'         => 'required|string|max:100',
            'email'        => 'required|email|max:150|unique:usuarios,email',
            'senha'        => 'required|string|min:6',
            'nivel_acesso' => 'required|in:admin,funcionario',
        ]);

        Usuario::create([
            'nome'         => trim($request->nome),
            'email'        => trim($request->email),
            'senha'        => password_hash($request->senha, PASSWORD_DEFAULT),
            'nivel_acesso' => $request->nivel_acesso,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nome'         => 'required|string|max:100',
            'email'        => 'required|email|max:150|unique:usuarios,email,' . $usuario->id,
            'nivel_acesso' => 'required|in:admin,funcionario',
        ]);

        $data = [
            'nome'         => trim($request->nome),
            'email'        => trim($request->email),
            'nivel_acesso' => $request->nivel_acesso,
        ];

        if (!empty($request->senha)) {
            $data['senha'] = password_hash($request->senha, PASSWORD_DEFAULT);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Usuario $usuario)
    {
        if ($usuario->id === session('user_id')) {
            return redirect()->route('usuarios.index')
                ->with('error', 'Você não pode excluir sua própria conta.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }
}
