@php
$userName  = session('user_name', 'Usuário');
$userEmail = session('user_email', '');
$userLevel = session('user_level', 'funcionario');
$uri       = request()->getRequestUri();
@endphp
<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Honda</title>
    <meta name="description" content="Painel de gerenciamento Honda - Carros, Motos, Funcionários e Usuários">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        honda: {
                            500: '#e11d48',
                            600: '#be123c',
                            700: '#9f1239',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }
    </style>
</head>
<body class="h-full font-sans antialiased bg-slate-950 overflow-hidden">

<div class="flex h-screen overflow-hidden">

    @include('includes.sidebar')

    <!-- Área de Conteúdo Principal -->
    <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

        <!-- Barra de Navegação Superior -->
        <header class="flex items-center justify-between px-6 py-4 bg-slate-900/60 backdrop-blur-md border-b border-slate-800/80 z-10 flex-shrink-0">
            <div class="flex items-center space-x-2">
                <span class="text-xs font-semibold px-2.5 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded-full uppercase tracking-wider">
                    Painel Administrativo
                </span>
            </div>

            <!-- Perfil do Usuário -->
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex flex-col items-end text-right">
                    <span class="text-sm font-semibold text-slate-200">{{ $userName }}</span>
                    <span class="text-xs font-medium text-slate-400">
                        {{ $userLevel === 'admin' ? 'Administrador' : 'Funcionário' }}
                    </span>
                </div>
                <div class="relative group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-red-600 to-rose-400 flex items-center justify-center font-bold text-white shadow-lg shadow-red-600/15 cursor-pointer select-none">
                        {{ strtoupper(substr($userName, 0, 1)) }}
                    </div>
                    <!-- Dropdown ao passar o mouse -->
                    <div class="absolute right-0 mt-2 w-52 bg-slate-900 border border-slate-800 rounded-xl shadow-xl py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="px-4 py-3 border-b border-slate-800">
                            <p class="text-xs text-slate-400">Logado como</p>
                            <p class="text-sm font-semibold text-slate-200 truncate">{{ $userEmail }}</p>
                        </div>
                        <a href="{{ BASE_URL }}logout.php" class="flex items-center px-4 py-2.5 text-sm text-rose-400 hover:bg-rose-950/20 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Sair da Conta
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Área de Conteúdo com Scroll -->
        <main class="flex-1 overflow-y-auto px-6 py-8">
