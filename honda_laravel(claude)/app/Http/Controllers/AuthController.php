<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = trim($request->input('email', ''));
        $senha = trim($request->input('senha', ''));

        if (empty($email) || empty($senha)) {
            return back()->with('error', 'Por favor, preencha o e-mail e a senha.')->withInput();
        }

        $user = DB::table('usuarios')->where('email', $email)->first();

        if ($user && password_verify($senha, $user->senha)) {
            session()->regenerate();
            session([
                'user_id'    => $user->id,
                'user_name'  => $user->nome,
                'user_email' => $user->email,
                'user_level' => $user->nivel_acesso,
            ]);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'E-mail ou senha inválidos. Tente novamente.')->withInput();
    }

    public function logout()
    {
        session()->flush();
        session()->invalidate();
        return redirect()->route('login');
    }
}
