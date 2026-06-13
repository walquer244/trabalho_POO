@php
$uri = request()->getRequestUri();
$isDashboard = (request()->is('/') || request()->is('index.php'));
$isCarros = (strpos($uri, '/carros/') !== false);
$isMotos = (strpos($uri, '/motos/') !== false);
$isFuncionarios = (strpos($uri, '/funcionarios/') !== false);
$isUsuarios = (strpos($uri, '/usuarios/') !== false);
$userLevel = session('user_level', 'funcionario');

if (!function_exists('navClass')) {
    function navClass(bool $active): string {
        if ($active) {
            return 'flex items-center px-3 py-2.5 text-sm font-semibold rounded-xl bg-red-600/10 text-red-400 border border-red-500/20 transition duration-150';
        }
        return 'flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border border-transparent transition duration-150';
    }
}
@endphp

<!-- ===== SIDEBAR ===== -->
<aside class="w-64 bg-slate-900 border-r border-slate-800/80 flex flex-col flex-shrink-0 h-full">

    <!-- Logo / Marca -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800/80 flex-shrink-0">
        <a href="{{ BASE_URL }}index.php" class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 flex items-center justify-center text-white font-black text-lg shadow-lg shadow-red-600/30">
                H
            </div>
            <span class="text-base font-bold tracking-tight bg-gradient-to-r from-white via-slate-100 to-slate-400 bg-clip-text text-transparent">
                Honda
            </span>
        </a>
    </div>

    <!-- Navegação -->
    <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">

        <!-- Seção: Principal -->
        <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Principal</p>

        <a href="{{ BASE_URL }}index.php" id="nav-dashboard" class="{{ navClass($isDashboard) }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <!-- Seção: Inventário -->
        <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-5 mb-2">Inventário</p>

        <a href="{{ BASE_URL }}carros/list.php" id="nav-carros" class="{{ navClass($isCarros) }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-4 5v-5M3 7l1.5 5h15L21 7M5 17h14a2 2 0 002-2v-4H3v4a2 2 0 002 2z"/>
            </svg>
            Carros
        </a>

        <a href="{{ BASE_URL }}motos/list.php" id="nav-motos" class="{{ navClass($isMotos) }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Motos
        </a>

        <!-- Seção: Administração (apenas para admin) -->
        @if ($userLevel === 'admin')
            <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-5 mb-2">Administração</p>

            <a href="{{ BASE_URL }}funcionarios/list.php" id="nav-funcionarios" class="{{ navClass($isFuncionarios) }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Funcionários
            </a>

            <a href="{{ BASE_URL }}usuarios/list.php" id="nav-usuarios" class="{{ navClass($isUsuarios) }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Usuários
            </a>
        @endif

    </nav>

    <!-- Rodapé da Sidebar: Botão Sair -->
    <div class="p-4 border-t border-slate-800/80 flex-shrink-0">
        <a href="{{ BASE_URL }}logout.php" id="btn-logout" class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold text-rose-400 bg-rose-950/20 border border-rose-500/10 rounded-xl hover:bg-rose-950/40 hover:border-rose-500/30 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Sair
        </a>
    </div>
</aside>
