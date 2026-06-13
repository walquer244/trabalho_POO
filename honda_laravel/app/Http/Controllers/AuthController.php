<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (!empty(session('user_id'))) {
            return redirect('/index.php');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $email = trim($request->input('email', ''));
        $senha = trim($request->input('senha', ''));

        if (empty($email) || empty($senha)) {
            return view('login', [
                'error' => 'Por favor, preencha o e-mail e a senha.',
                'email' => $email
            ]);
        }

        try {
            $user = Usuario::where('email', $email)->first();

            if ($user && Hash::check($senha, $user->senha)) {
                session()->regenerate();
                session([
                    'user_id'    => $user->id,
                    'user_name'  => $user->nome,
                    'user_email' => $user->email,
                    'user_level' => $user->nivel_acesso,
                ]);

                return redirect('/index.php');
            } else {
                return view('login', [
                    'error' => 'E-mail ou senha inválidos. Tente novamente.',
                    'email' => $email
                ]);
            }
        } catch (\Exception $e) {
            return view('login', [
                'error' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage(),
                'email' => $email
            ]);
        }
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email', 'user_level']);
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login.php');
    }
}
