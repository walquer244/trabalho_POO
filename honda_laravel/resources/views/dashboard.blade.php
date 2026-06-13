@include('includes.header')

<div class="space-y-8">

    <!-- Alerta de Erro de Acesso -->
    @if (request()->query('error'))
        <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-2xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span>
                @if (request()->query('error') === 'acesso_negado')
                    Acesso negado. Você não tem permissão de administrador para acessar essa área.
                @else
                    {{ request()->query('error') }}
                @endif
            </span>
        </div>
    @endif

    <!-- Banner de Boas-vindas -->
    <div class="relative bg-gradient-to-r from-red-900/30 via-red-950/10 to-slate-900/50 p-8 rounded-3xl border border-red-500/10 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,rgba(225,29,72,0.08),transparent_60%)]"></div>
        <div class="relative z-10">
            <p class="text-xs font-bold text-red-400 uppercase tracking-widest mb-2">Painel Principal</p>
            <h2 class="text-3xl font-extrabold tracking-tight text-white mb-2">
                Olá, {{ session('user_name', 'Usuário') }}! 👋
            </h2>
            <p class="text-slate-400 text-sm leading-relaxed max-w-xl">
                Bem-vindo ao sistema de gerenciamento Honda. Use o menu lateral para gerenciar
                o inventário de veículos, funcionários e usuários do sistema.
            </p>
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- Carros -->
        <a href="{{ BASE_URL }}carros/list.php" class="group bg-slate-900/60 border border-slate-800 hover:border-blue-500/30 rounded-2xl p-6 transition duration-200 block">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total de Carros</span>
                <div class="p-2 bg-blue-500/10 text-blue-400 rounded-xl group-hover:bg-blue-500/20 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-4 5v-5M3 7l1.5 5h15L21 7M5 17h14a2 2 0 002-2v-4H3v4a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline space-x-2 mb-1">
                <span class="text-3xl font-extrabold text-white">{{ $numCarros }}</span>
                <span class="text-sm text-slate-500">veículos</span>
            </div>
            <p class="text-xs text-slate-400">
                Estoque: <span class="text-slate-300 font-semibold">{{ format_currency((float)$valCarros) }}</span>
            </p>
        </a>

        <!-- Motos -->
        <a href="{{ BASE_URL }}motos/list.php" class="group bg-slate-900/60 border border-slate-800 hover:border-amber-500/30 rounded-2xl p-6 transition duration-200 block">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total de Motos</span>
                <div class="p-2 bg-amber-500/10 text-amber-400 rounded-xl group-hover:bg-amber-500/20 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline space-x-2 mb-1">
                <span class="text-3xl font-extrabold text-white">{{ $numMotos }}</span>
                <span class="text-sm text-slate-500">unidades</span>
            </div>
            <p class="text-xs text-slate-400">
                Estoque: <span class="text-slate-300 font-semibold">{{ format_currency((float)$valMotos) }}</span>
            </p>
        </a>

        <!-- Valor Total em Estoque -->
        <div class="bg-slate-900/60 border border-slate-800 hover:border-emerald-500/30 rounded-2xl p-6 transition duration-200">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Valor em Estoque</span>
                <div class="p-2 bg-emerald-500/10 text-emerald-400 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline space-x-1 mb-1">
                <span class="text-2xl font-extrabold text-white truncate">{{ format_currency($valTotal) }}</span>
            </div>
            <p class="text-xs text-slate-400">Soma de carros + motos</p>
        </div>

        <!-- Recursos Humanos -->
        <div class="bg-slate-900/60 border border-slate-800 hover:border-purple-500/30 rounded-2xl p-6 transition duration-200">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Recursos Humanos</span>
                <div class="p-2 bg-purple-500/10 text-purple-400 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline space-x-2 mb-1">
                <span class="text-3xl font-extrabold text-white">{{ $numFuncionarios }}</span>
                <span class="text-sm text-slate-500">funcionários</span>
            </div>
            <p class="text-xs text-slate-400">
                <span class="text-slate-300 font-semibold">{{ $numUsuarios }}</span> usuários cadastrados
            </p>
        </div>
    </div>

    <!-- Listagens Recentes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Carros Recentes -->
        <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-white">Carros Recentes</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Últimos cadastros no estoque</p>
                </div>
                <a href="{{ BASE_URL }}carros/list.php" class="text-xs font-semibold text-red-400 hover:text-red-300 transition-colors flex items-center">
                    Ver todos
                    <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="space-y-3">
                @if (count($recentCarros) > 0)
                    @foreach ($recentCarros as $c)
                        <div class="flex items-center justify-between p-4 bg-slate-900/70 border border-slate-800/80 rounded-2xl hover:border-slate-700 transition">
                            <div class="min-w-0">
                                <h4 class="text-sm font-bold text-slate-200 truncate">{{ $c->marca . ' ' . $c->modelo }}</h4>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $c->cor }} • {{ $c->ano }}</p>
                            </div>
                            <span class="text-sm font-bold text-red-400 flex-shrink-0 ml-4">{{ format_currency((float)$c->valor) }}</span>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-slate-500 py-6 text-center">Nenhum carro cadastrado ainda.</p>
                @endif
            </div>
        </div>

        <!-- Motos Recentes -->
        <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-white">Motos Recentes</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Últimas motocicletas cadastradas</p>
                </div>
                <a href="{{ BASE_URL }}motos/list.php" class="text-xs font-semibold text-red-400 hover:text-red-300 transition-colors flex items-center">
                    Ver todas
                    <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="space-y-3">
                @if (count($recentMotos) > 0)
                    @foreach ($recentMotos as $m)
                        <div class="flex items-center justify-between p-4 bg-slate-900/70 border border-slate-800/80 rounded-2xl hover:border-slate-700 transition">
                            <div class="min-w-0">
                                <h4 class="text-sm font-bold text-slate-200 truncate">{{ $m->marca . ' ' . $m->modelo }}</h4>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $m->cor }} • {{ $m->ano }}</p>
                            </div>
                            <span class="text-sm font-bold text-amber-400 flex-shrink-0 ml-4">{{ format_currency((float)$m->valor) }}</span>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-slate-500 py-6 text-center">Nenhuma moto cadastrada ainda.</p>
                @endif
            </div>
        </div>
    </div>

</div>

@include('includes.footer')
