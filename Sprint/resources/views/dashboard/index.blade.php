@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6 animate-fade-in-up">
    <h2 class="text-2xl font-bold text-white">Relatórios de Desempenho</h2>
    <p class="text-sm text-gray-500 mt-0.5">Visão consolidada de métricas, estoque e clientes do sistema.</p>
</div>

{{-- Metrics Cards Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

    {{-- Card Produtos --}}
    <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 flex flex-col justify-between shadow-md animate-fade-in-up">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-orange-950/40 border border-orange-900/30 flex items-center justify-center text-orange-500">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-green-950/40 text-green-400 border border-green-900/40">+4.2%</span>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium">Total de Produtos</p>
            <p class="text-2xl font-bold text-white mt-1">{{ number_format($totalProdutos) }}</p>
        </div>
    </div>

    {{-- Card Clientes --}}
    <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 flex flex-col justify-between shadow-md animate-fade-in-up delay-75">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-green-950/40 border border-green-900/30 flex items-center justify-center text-green-500">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-green-950/40 text-green-400 border border-green-900/40">+12%</span>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium">Total de Clientes</p>
            <p class="text-2xl font-bold text-white mt-1">{{ number_format($totalClientes) }}</p>
        </div>
    </div>

    {{-- Card Funcionários --}}
    @if(auth()->user()->isAdmin())
    <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 flex flex-col justify-between shadow-md animate-fade-in-up delay-150">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-blue-950/40 border border-blue-900/30 flex items-center justify-center text-blue-500">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-red-950/40 text-red-400 border border-red-900/40">-2.1%</span>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium">Funcionários Cadastrados</p>
            <p class="text-2xl font-bold text-white mt-1">{{ number_format($totalFuncionarios) }}</p>
        </div>
    </div>
    @else
    {{-- Card Placeholder when Employee logs in to balance visual grid --}}
    <div class="bg-gray-900/40 rounded-xl border border-gray-900/60 border-dashed p-6 flex flex-col justify-center items-center shadow-sm animate-fade-in-up delay-150">
        <p class="text-xs text-gray-600 font-medium text-center">Nível de Acesso Limitado</p>
        <p class="text-[10px] text-gray-600 mt-1 text-center">Gerenciamento de pessoal restrito ao administrador.</p>
    </div>
    @endif
</div>

{{-- Split Two-Column Section --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Left: Stock Capacity Overview (2/3 width) --}}
    <div class="lg:col-span-2 bg-gray-900 rounded-xl border border-gray-800 p-6 shadow-md animate-fade-in-up delay-150">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-base font-semibold text-white">Desempenho de Estoque</h3>
                <p class="text-xs text-gray-500 mt-0.5">Visão de capacidade de produtos ativos no estoque.</p>
            </div>
            <div class="flex items-center bg-gray-950/80 border border-gray-850 rounded-lg p-0.5">
                <button class="px-3 py-1 text-[10px] font-semibold rounded text-white bg-gray-800 shadow-sm">7 Dias</button>
                <button class="px-3 py-1 text-[10px] font-semibold rounded text-gray-500 hover:text-white">30 Dias</button>
                <button class="px-3 py-1 text-[10px] font-semibold rounded text-gray-500 hover:text-white">Ano</button>
            </div>
        </div>

        {{-- Progress Stock indicators --}}
        <div class="space-y-4">
            @php
                $topProducts = \App\Models\Produto::latest()->take(4)->get();
            @endphp
            @if($topProducts->isEmpty())
                <div class="py-12 text-center text-gray-600 text-xs">
                    Nenhum produto cadastrado para exibir no resumo de estoque.
                </div>
            @else
                @foreach($topProducts as $item)
                    @php
                        $percentage = min(100, max(0, ($item->quantidade_estoque / 100) * 100));
                    @endphp
                    <div>
                        <div class="flex justify-between text-xs text-gray-400 mb-1.5 font-medium">
                            <span class="text-white">{{ $item->nome }}</span>
                            <span>{{ $item->quantidade_estoque }} / 100 unidades ({{ number_format($percentage) }}%)</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-orange-500 h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    {{-- Right: Export Data Tools (1/3 width) --}}
    <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 flex flex-col justify-between shadow-md animate-fade-in-up delay-225">
        <div>
            <h3 class="text-base font-semibold text-white">Exportar Dados</h3>
            <p class="text-xs text-gray-500 mt-1">Selecione o formato desejado para baixar o relatório completo da loja.</p>

            <div class="space-y-3 mt-6">
                <!-- PDF -->
                <button onclick="window.print()" class="w-full flex items-center justify-between p-3 rounded-lg border border-gray-800 bg-gray-950/60 hover:bg-gray-800/30 transition-all duration-200 cursor-pointer">
                    <span class="flex items-center gap-2 text-xs font-semibold text-gray-300">
                        <svg class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Documento PDF
                    </span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </button>

                <!-- CSV -->
                <a href="{{ route('produtos.index') }}" class="w-full flex items-center justify-between p-3 rounded-lg border border-gray-800 bg-gray-950/60 hover:bg-gray-800/30 transition-all duration-200 cursor-pointer">
                    <span class="flex items-center gap-2 text-xs font-semibold text-gray-300">
                        <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Planilha CSV
                    </span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="border-t border-gray-800/60 pt-4 mt-6 flex items-center justify-between text-[10px] text-gray-500 font-semibold">
            <span>Última atualização</span>
            <span class="text-orange-500">Há 5 minutos</span>
        </div>
    </div>
</div>

{{-- Bottom Card: Recent Clients List --}}
<div class="bg-gray-900 rounded-xl border border-gray-800 p-6 shadow-md animate-fade-in-up delay-300">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-base font-semibold text-white">Clientes Recentes</h3>
            <p class="text-xs text-gray-500 mt-0.5">Visão simplificada dos últimos clientes cadastrados no painel.</p>
        </div>
        <a href="{{ route('clientes.index') }}" class="text-xs font-semibold text-orange-500 hover:text-orange-400 transition-colors">Ver tudo</a>
    </div>

    @php
        $recentClients = \App\Models\Cliente::latest()->take(3)->get();
    @endphp
    @if($recentClients->isEmpty())
        <div class="py-10 text-center text-gray-600 text-xs">
            Nenhum cliente cadastrado ainda.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-gray-800 text-gray-500 font-semibold uppercase tracking-wider">
                        <th class="py-3">Nome</th>
                        <th class="py-3">Idade</th>
                        <th class="py-3">Desconto</th>
                        <th class="py-3 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($recentClients as $cli)
                    <tr class="hover-row">
                        <td class="py-3.5 font-medium text-white flex items-center gap-2">
                            <div class="w-6 h-6 rounded bg-gray-800 flex items-center justify-center text-gray-400 font-bold uppercase text-[10px]">
                                {{ substr($cli->nome, 0, 1) }}
                            </div>
                            {{ $cli->nome }}
                        </td>
                        <td class="py-3.5 text-gray-300">{{ $cli->idade }} anos</td>
                        <td class="py-3.5 text-gray-300">{{ number_format($cli->desconto, 2, ',', '.') }}%</td>
                        <td class="py-3.5 text-right">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-green-950/40 text-green-400 border border-green-900/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Ativo
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection