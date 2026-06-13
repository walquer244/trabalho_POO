<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $success = $request->query('success', '');
        $error   = $request->query('error', '');

        try {
            $usuarios = Usuario::orderBy('id', 'desc')->get();
            return view('usuarios.list', compact('usuarios', 'success', 'error'));
        } catch (\Exception $e) {
            die("Erro ao carregar usuários: " . $e->getMessage());
        }
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $nome         = trim($request->input('nome', ''));
        $email        = trim($request->input('email', ''));
        $nivel_acesso = $request->input('nivel_acesso', 'funcionario');
        $senha        = trim($request->input('senha', ''));

        if (empty($nome) || empty($email) || empty($senha)) {
            $error = "Preencha todos os campos obrigatórios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "E-mail inválido.";
        } else {
            try {
                $exists = Usuario::where('email', $email)->exists();
                if ($exists) {
                    $error = "E-mail já cadastrado por outro usuário.";
                } else {
                    Usuario::create([
                        'nome'         => $nome,
                        'email'        => $email,
                        'senha'        => Hash::make($senha),
                        'nivel_acesso' => $nivel_acesso
                    ]);
                    return redirect('/usuarios/list.php?success=' . urlencode("Usuário cadastrado com sucesso."));
                }
            } catch (\Exception $e) {
                $error = "Erro ao cadastrar usuário: " . $e->getMessage();
            }
        }

        return view('usuarios.create', compact('error', 'nome', 'email', 'nivel_acesso'));
    }

    public function edit(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/usuarios/list.php');
        }

        $user = Usuario::find($id);
        if (!$user) {
            return redirect('/usuarios/list.php');
        }

        return view('usuarios.edit', compact('user', 'id'));
    }

    public function update(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/usuarios/list.php');
        }

        $user = Usuario::find($id);
        if (!$user) {
            return redirect('/usuarios/list.php');
        }

        $nome         = trim($request->input('nome', ''));
        $email        = trim($request->input('email', ''));
        $nivel_acesso = $request->input('nivel_acesso', 'funcionario');
        $senha        = trim($request->input('senha', ''));

        if (empty($nome) || empty($email)) {
            $error = "Nome e e-mail são obrigatórios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "E-mail inválido.";
        } else {
            try {
                $exists = Usuario::where('email', $email)->where('id', '!=', $id)->exists();
                if ($exists) {
                    $error = "E-mail já está sendo utilizado por outro usuário.";
                } else {
                    $data = [
                        'nome'         => $nome,
                        'email'        => $email,
                        'nivel_acesso' => $nivel_acesso
                    ];
                    if (!empty($senha)) {
                        $data['senha'] = Hash::make($senha);
                    }
                    $user->update($data);

                    if ($id === (int)session('user_id')) {
                        session([
                            'user_name'  => $nome,
                            'user_email' => $email,
                            'user_level' => $nivel_acesso,
                        ]);
                    }

                    return redirect('/usuarios/list.php?success=' . urlencode("Usuário atualizado com sucesso."));
                }
            } catch (\Exception $e) {
                $error = "Erro ao atualizar usuário: " . $e->getMessage();
            }
        }

        return view('usuarios.edit', compact('user', 'id', 'error'));
    }

    public function destroy(Request $request)
    {
        $id = (int)$request->query('id', 0);
        if ($id <= 0) {
            return redirect('/usuarios/list.php');
        }

        if ($id === (int)session('user_id')) {
            return redirect('/usuarios/list.php?error=' . urlencode("Você não pode excluir sua própria conta."));
        }

        try {
            $user = Usuario::find($id);
            if ($user) {
                $user->delete();
                return redirect('/usuarios/list.php?success=' . urlencode("Usuário excluído com sucesso do sistema."));
            }
            return redirect('/usuarios/list.php?error=' . urlencode("Usuário não encontrado."));
        } catch (\Exception $e) {
            return redirect('/usuarios/list.php?error=' . urlencode("Erro ao excluir usuário: " . $e->getMessage()));
        }
    }
}
