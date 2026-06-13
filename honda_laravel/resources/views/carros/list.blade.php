@include('includes.header')

<div class="space-y-6">

    <!-- Cabeçalho da Página -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Estoque de Carros</h1>
            <p class="text-slate-400 text-sm mt-1">Gerencie os carros cadastrados no inventário</p>
        </div>
        <a href="create.php" id="btn-novo-carro"
           class="mt-4 sm:mt-0 inline-flex items-center justify-center bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold py-2.5 px-5 rounded-xl text-sm transition shadow-lg shadow-red-600/15">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Adicionar Carro
        </a>
    </div>

    <!-- Alertas de Sucesso / Erro -->
    @if (!empty($error))
        <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-2xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span>{{ $error }}</span>
        </div>
    @endif
    @if (!empty($success))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm rounded-2xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ $success }}</span>
        </div>
    @endif

    <!-- Tabela de Carros -->
    <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-900/60 border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">#</th>
                        <th class="py-4 px-6">Marca</th>
                        <th class="py-4 px-6">Modelo</th>
                        <th class="py-4 px-6">Cor</th>
                        <th class="py-4 px-6">Ano</th>
                        <th class="py-4 px-6">Valor</th>
                        <th class="py-4 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @if (count($carros) > 0)
                        @foreach ($carros as $car)
                            <tr class="hover:bg-slate-900/30 transition-colors">
                                <td class="py-4 px-6 text-slate-500 font-mono text-xs">#{{ $car->id }}</td>
                                <td class="py-4 px-6 font-bold text-white">{{ $car->marca }}</td>
                                <td class="py-4 px-6 text-slate-300">{{ $car->modelo }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                        {{ $car->cor }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-400 font-medium">{{ $car->ano }}</td>
                                <td class="py-4 px-6 font-bold text-red-400">{{ format_currency((float)$car->valor) }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="edit.php?id={{ $car->id }}"
                                           id="btn-edit-carro-{{ $car->id }}"
                                           title="Editar"
                                           class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl border border-transparent hover:border-slate-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <a href="delete.php?id={{ $car->id }}"
                                           id="btn-delete-carro-{{ $car->id }}"
                                           title="Excluir"
                                           onclick="return confirm('Deseja realmente excluir este carro?')"
                                           class="p-2 text-rose-500 hover:text-rose-400 hover:bg-rose-950/20 rounded-xl border border-transparent hover:border-rose-500/20 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-slate-500">
                                Nenhum carro cadastrado. <a href="create.php" class="text-red-400 hover:underline">Adicionar o primeiro.</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>

@include('includes.footer')
