<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint – Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center gap-3">
            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-white text-3xl font-bold tracking-wide">Sprint</span>
        </div>
        <p class="mt-2 text-gray-500 text-sm">Loja de Artigos Esportivos</p>
    </div>

    {{-- Card --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">
        <h2 class="text-white text-xl font-semibold mb-1">Bem-vindo de volta</h2>
        <p class="text-gray-500 text-sm mb-6">Entre com suas credenciais para acessar o sistema.</p>

        {{-- Erros gerais --}}
        @if($errors->any())
            <div class="mb-4 bg-red-900/30 border border-red-700 rounded-lg px-4 py-3">
                <ul class="text-sm text-red-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">
                    E-mail
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="seu@email.com"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 text-sm
                           placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent
                           transition @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Senha --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">
                    Senha
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 text-sm
                           placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent
                           transition @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="w-4 h-4 rounded border-gray-600 bg-gray-800 text-orange-500 focus:ring-orange-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-400">Manter conectado</label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 active:bg-orange-700 text-white font-semibold
                           py-2.5 rounded-lg text-sm transition shadow-lg shadow-orange-500/20">
                Entrar
            </button>
        </form>
    </div>

    {{-- Credenciais de acesso --}}
    <div class="mt-4 bg-gray-900/50 border border-gray-800 rounded-xl p-4 text-xs text-gray-500">
        <p class="font-medium text-gray-400 mb-1">Credenciais padrão:</p>
        <p>Admin: <span class="text-gray-300">admin@sprint.com</span> / <span class="text-gray-300">admin123</span></p>
        <p>Funcionário: <span class="text-gray-300">funcionario@sprint.com</span> / <span class="text-gray-300">func123</span></p>
    </div>
</div>

</body>
</html>