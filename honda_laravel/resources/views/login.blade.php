<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistema Honda</title>
    <meta name="description" content="Acesse o painel administrativo da Honda">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] } } }
        }
    </script>
</head>
<body class="h-full font-sans antialiased bg-slate-950 text-slate-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Card de Login -->
        <div class="bg-slate-900/80 backdrop-blur-md border border-slate-800 rounded-3xl shadow-2xl shadow-black/50 p-8">

            <!-- Logo -->
            <div class="flex items-center justify-center mb-8">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-600 to-rose-700 flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-red-600/40">
                        H
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-white">Honda</h1>
                        <p class="text-xs text-slate-400 font-medium">Sistema de Gerenciamento</p>
                    </div>
                </div>
            </div>

            <h2 class="text-lg font-bold text-white mb-1 text-center">Bem-vindo de volta</h2>
            <p class="text-sm text-slate-400 text-center mb-7">Entre com suas credenciais para acessar o painel</p>

            <!-- Alerta de Erro -->
            @if (!empty($error))
                <div class="mb-5 p-4 bg-rose-500/10 border border-rose-500/25 text-rose-400 text-sm rounded-2xl flex items-center space-x-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $error }}</span>
                </div>
            @endif

            <!-- Formulário -->
            <form method="POST" action="{{ url('/login.php') }}" class="space-y-5" id="form-login">
                @csrf
                <!-- E-mail -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        E-mail
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        placeholder="admin@honda.com.br"
                        value="{{ $email ?? '' }}"
                        class="w-full bg-slate-950/70 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm"
                    >
                </div>

                <!-- Senha -->
                <div>
                    <label for="senha" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Senha
                    </label>
                    <input
                        type="password"
                        name="senha"
                        id="senha"
                        required
                        placeholder="••••••••"
                        class="w-full bg-slate-950/70 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm"
                    >
                </div>

                <!-- Botão Entrar -->
                <button
                    type="submit"
                    id="btn-login"
                    class="w-full bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-bold py-3 px-6 rounded-xl transition shadow-lg shadow-red-600/25 text-sm mt-2"
                >
                    Entrar no Sistema
                </button>
            </form>
        </div>

    </div>
</body>
</html>
