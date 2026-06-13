@include('includes.header')

<div class="space-y-6">
    <!-- Header banner -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white font-sans">Quadro de Funcionários</h1>
            <p class="text-slate-400 text-sm mt-1">Gerencie a equipe e acompanhe a folha salarial</p>
        </div>
        
        <a href="create.php" class="mt-4 sm:mt-0 flex items-center justify-center bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition shadow-lg shadow-red-600/15">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Contratar Funcionário
        </a>
    </div>

    <!-- Alert Displays -->
    @if (!empty($error))
        <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-2xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span>{{ $error }}</span>
        </div>
    @endif
    @if (!empty($success))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm rounded-2xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ $success }}</span>
        </div>
    @endif

    <!-- HR Dashboard Mini-stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-slate-900/40 p-5 border border-slate-800/80 rounded-2xl">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Colaboradores Ativos</p>
            <p class="text-2xl font-bold text-white">{{ $totalFuncionarios }}</p>
        </div>
        <div class="bg-slate-900/40 p-5 border border-slate-800/80 rounded-2xl">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Folha de Pagamento</p>
            <p class="text-2xl font-bold text-white">{{ format_currency($folhaSalarial) }}</p>
        </div>
        <div class="bg-slate-900/40 p-5 border border-slate-800/80 rounded-2xl">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Média Salarial</p>
            <p class="text-2xl font-bold text-white">{{ format_currency($mediaSalarial) }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-900/60 border-b border-slate-800 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Nome</th>
                        <th class="py-4 px-6">Função</th>
                        <th class="py-4 px-6">Data de Admissão</th>
                        <th class="py-4 px-6">Data de Nascimento</th>
                        <th class="py-4 px-6">Salário</th>
                        <th class="py-4 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @if (count($funcionarios) > 0)
                        @foreach ($funcionarios as $func)
                            <tr class="hover:bg-slate-900/20 transition-colors">
                                <td class="py-4 px-6 font-bold text-white">{{ $func->nome }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                        {{ $func->funcao }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-400">{{ format_date($func->data_admissao) }}</td>
                                <td class="py-4 px-6 text-slate-400">{{ format_date($func->data_nascimento) }}</td>
                                <td class="py-4 px-6 font-bold text-emerald-400">{{ format_currency($func->salario) }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="edit.php?id={{ $func->id }}" class="text-slate-400 hover:text-white transition" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <a href="delete.php?id={{ $func->id }}" 
                                           onclick="return confirm('Deseja realmente excluir este funcionário?')" 
                                           class="text-rose-500 hover:text-rose-400 transition" title="Excluir">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-slate-500">Nenhum funcionário cadastrado no momento.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('includes.footer')
