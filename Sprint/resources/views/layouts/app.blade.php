<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sprint – @yield('title', 'Painel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sprint: {
                            50:  '#fff7ed',
                            100: '#ffedd5',
                            500: '#f97316',
                            600: '#ea6c0a',
                            700: '#c2550a',
                            900: '#431407',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Keyframe Animations */
        @keyframes slideIn {
            from {
                transform: translateX(120%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(120%);
                opacity: 0;
            }
        }
        @keyframes shrinkProgress {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Utility Animation Classes */
        .toast-item {
            animation: slideIn 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        .toast-item.hide {
            animation: slideOut 0.3s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards;
        }
        .toast-progress {
            animation: shrinkProgress 5s linear forwards;
        }
        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .delay-75 { animation-delay: 75ms; }
        .delay-150 { animation-delay: 150ms; }
        .delay-225 { animation-delay: 225ms; }
        .delay-300 { animation-delay: 300ms; }
        
        /* Table Row Slide-on-Hover */
        tr.hover-row {
            transition: all 0.2s ease-out;
        }
        tr.hover-row:hover {
            background-color: rgba(31, 41, 55, 0.5) !important;
            transform: translateX(4px);
        }
        
        /* Input Focus Effects */
        .bg-gray-900 form input {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .bg-gray-900 form input:focus {
            transform: scale(1.008);
            box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.08) !important;
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased p-4 h-screen overflow-hidden flex items-center justify-center">

<div class="w-full h-full max-h-[calc(100vh-2rem)] rounded-2xl border border-gray-800 bg-gray-950 shadow-2xl flex overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 border-r border-gray-800 flex flex-col flex-shrink-0">
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-800">
            <div class="w-9 h-9 bg-orange-500 rounded-lg flex items-center justify-center shadow-md shadow-orange-500/20">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <span class="text-white text-base font-bold tracking-wide block">Sprint</span>
                <span class="text-[9px] text-gray-500 font-medium block -mt-1 uppercase">Management Console</span>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 py-4 space-y-0.5 overflow-y-auto">
            @php $user = auth()->user(); @endphp

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('dashboard') ? 'border-orange-500 bg-gray-800/40 text-orange-500' : 'border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('produtos.index') }}"
               class="flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('produtos.*') ? 'border-orange-500 bg-gray-800/40 text-orange-500' : 'border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Produtos
            </a>

            @if($user->isAdmin())
            <a href="{{ route('funcionarios.index') }}"
               class="flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('funcionarios.*') ? 'border-orange-500 bg-gray-800/40 text-orange-500' : 'border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Funcionários
            </a>

            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('users.*') ? 'border-orange-500 bg-gray-800/40 text-orange-500' : 'border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Usuários
            </a>
            @endif

            <a href="{{ route('clientes.index') }}"
               class="flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('clientes.*') ? 'border-orange-500 bg-gray-800/40 text-orange-500' : 'border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Clientes
            </a>
        </nav>

        {{-- Bottom actions --}}
        <div class="border-t border-gray-800 py-2">
            <a href="#" class="flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 border-transparent text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800/20 transition-all duration-200">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Configurações
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 pl-5 pr-4 py-3 border-l-4 border-transparent text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800/20 transition-all duration-200 cursor-pointer">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sair
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col overflow-hidden bg-gray-950">
        {{-- Topbar --}}
        <header class="bg-gray-900 border-b border-gray-800 px-6 py-3 flex items-center justify-between flex-shrink-0">
            <!-- Search bar -->
            <div class="relative w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" placeholder="Pesquisar no sistema..." class="w-full bg-gray-950/60 border border-gray-800 text-xs rounded-lg pl-9 pr-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/30 transition-all">
            </div>

            <!-- Profile actions -->
            <div class="flex items-center gap-4">
                <!-- Notification -->
                <button class="text-gray-400 hover:text-white transition-colors relative cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-0.5 right-0.5 w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                </button>
                <!-- Help -->
                <button class="text-gray-400 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
                <!-- Divider -->
                <span class="w-px h-5 bg-gray-800"></span>
                <!-- Profile info -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold shadow-md shadow-orange-500/20">
                        {{ strtoupper(substr($user->email, 0, 1)) }}
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-xs text-white font-semibold truncate max-w-[120px]">{{ explode('@', $user->email)[0] }}</p>
                        <span class="text-[9px] text-gray-500 block -mt-0.5 font-medium uppercase tracking-wider">{{ $user->role }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main class="flex-1 overflow-y-auto p-6 bg-gray-950">
            @yield('content')
        </main>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none">
    @if(session('success'))
        <div class="toast-item flex items-center gap-3 bg-gray-900/95 backdrop-blur-md border border-green-800 text-gray-100 pl-4 pr-10 py-3.5 rounded-xl shadow-2xl relative overflow-hidden pointer-events-auto cursor-pointer select-none max-w-sm transition-all duration-300">
            <div class="w-8 h-8 rounded-lg bg-green-950/50 border border-green-800/30 flex items-center justify-center text-green-400 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-white">Sucesso</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ session('success') }}</p>
            </div>
            <button class="absolute top-3.5 right-3 text-gray-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="absolute bottom-0 left-0 h-1 bg-green-500 toast-progress"></div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-item flex items-center gap-3 bg-gray-900/95 backdrop-blur-md border border-red-800 text-gray-100 pl-4 pr-10 py-3.5 rounded-xl shadow-2xl relative overflow-hidden pointer-events-auto cursor-pointer select-none max-w-sm transition-all duration-300">
            <div class="w-8 h-8 rounded-lg bg-red-950/50 border border-red-800/30 flex items-center justify-center text-red-400 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-white">Erro</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ session('error') }}</p>
            </div>
            <button class="absolute top-3.5 right-3 text-gray-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="absolute bottom-0 left-0 h-1 bg-red-500 toast-progress"></div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('.toast-item');
        toasts.forEach(toast => {
            const dismiss = () => {
                if (toast.classList.contains('hide')) return;
                toast.classList.add('hide');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            };

            // Dismiss after progress bar ends (5000ms)
            setTimeout(dismiss, 5000);

            // Dismiss on click (button or body)
            toast.addEventListener('click', dismiss);
        });
    });
</script>

</body>
</html>