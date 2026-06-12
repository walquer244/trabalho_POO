<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema Honda') — Honda Concessionária</title>
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
<body class="h-full font-sans antialiased bg-slate-950 text-slate-100">

<div class="flex h-full min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 flex-shrink-0 bg-slate-950 border-r border-slate-800/80 flex flex-col fixed top-0 left-0 h-full z-30">

        <!-- Logo -->
        <div class="flex items-center space-x-3 px-6 py-5 border-b border-slate-800/60">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 flex items-center justify-center text-white font-black text-lg shadow-lg shadow-red-600/30">
                H
            </div>
            <div>
                <span class="text-sm font-extrabold text-white tracking-tight">Honda</span>
                <p class="text-[10px] text-slate-500 font-medium">Concessionária</p>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1">

            <a href="{{ route('dashboard') }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-red-600/15 text-red-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-3 pt-4 pb-1">Estoque</p>

            <a href="{{ route('carros.index') }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('carros.*') ? 'bg-blue-600/15 text-blue-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-4 5v-5M3 7l1.5 5h15L21 7M5 17h14a2 2 0 002-2v-4H3v4a2 2 0 002 2z"/>
                </svg>
                <span>Carros</span>
            </a>

            <a href="{{ route('motos.index') }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('motos.*') ? 'bg-amber-600/15 text-amber-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span>Motos</span>
            </a>

            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-3 pt-4 pb-1">Pessoas</p>

            <a href="{{ route('funcionarios.index') }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('funcionarios.*') ? 'bg-purple-600/15 text-purple-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Funcionários</span>
            </a>

            @if(session('user_level') === 'admin')
            <a href="{{ route('usuarios.index') }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('usuarios.*') ? 'bg-emerald-600/15 text-emerald-400' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span>Usuários</span>
            </a>
            @endif

        </nav>

        <!-- User / Logout -->
        <div class="border-t border-slate-800/60 px-4 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-xs font-bold text-slate-300">
                    {{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-white truncate">{{ session('user_name') }}</p>
                    <p class="text-[10px] text-slate-500 truncate capitalize">{{ session('user_level') }}</p>
                </div>
                <a href="{{ route('logout') }}" title="Sair"
                   class="p-1.5 text-slate-500 hover:text-rose-400 hover:bg-slate-800 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 py-8">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
