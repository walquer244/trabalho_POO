@extends('layouts.app')
@section('title', 'Funcionários')

@section('content')
<div class="flex items-center justify-between mb-6 animate-fade-in-up">
    <div>
        <h2 class="text-2xl font-bold text-white font-sans">Funcionários</h2>
        <p class="text-sm text-gray-500 mt-0.5">Gerencie os registros do pessoal da equipe de administração e vendas.</p>
    </div>
    <a href="{{ route('funcionarios.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold rounded-lg shadow-md hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 cursor-pointer">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Novo Funcionário
    </a>
</div>

{{-- Filter and Sort Pills Bar --}}
<div class="bg-gray-900 border border-gray-800 rounded-xl p-4 mb-6 flex flex-wrap items-center justify-between gap-4 animate-fade-in-up delay-75">
    <div class="flex items-center gap-2 overflow-x-auto">
        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filtros:
        </span>
        <button class="px-3.5 py-1 text-xs font-semibold rounded-full border bg-orange-500/10 text-orange-400 border-orange-500/30">Todos</button>
        <button class="px-3.5 py-1 text-xs font-semibold rounded-full border border-gray-800 bg-gray-950/40 text-gray-400 hover:text-white transition-all">Gerência</button>
        <button class="px-3.5 py-1 text-xs font-semibold rounded-full border border-gray-800 bg-gray-950/40 text-gray-400 hover:text-white transition-all">Admissões Recentes</button>
    </div>
    
    <div class="flex items-center gap-3">
        <!-- Date Picker Button Mock -->
        <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-800 bg-gray-950/60 text-xs text-gray-300 hover:bg-gray-800/30 transition-all font-semibold cursor-pointer">
            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Todos os anos
        </button>
        <button class="p-1.5 rounded-lg border border-gray-800 bg-gray-950 hover:bg-gray-800/30 text-gray-400 hover:text-white cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l-4-4m4 4V4"/>
            </svg>
        </button>
    </div>
</div>

{{-- Data Card Container --}}
<div class="bg-gray-900 rounded-xl border border-gray-800 shadow-md overflow-hidden animate-fade-in-up delay-150">
    @if($funcionarios->isEmpty())
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-gray-700 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-gray-500 text-sm">Nenhum funcionário cadastrado ainda.</p>
            <a href="{{ route('funcionarios.create') }}" class="mt-3 inline-block text-orange-500 text-sm hover:underline">
                Cadastrar primeiro funcionário →
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-800 bg-gray-800/20 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Funcionário</th>
                        <th class="px-6 py-4">Função</th>
                        <th class="px-6 py-4">Salário</th>
                        <th class="px-6 py-4">Admissão</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($funcionarios as $funcionario)
                    <tr class="hover-row">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                {{-- Thumbnail Employee Icon Box --}}
                                <div class="w-10 h-10 rounded-lg bg-gray-850 border border-gray-800 flex items-center justify-center text-gray-400 flex-shrink-0 font-bold uppercase text-xs">
                                    {{ substr($funcionario->nome, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-white text-xs">{{ $funcionario->nome }}</p>
                                    <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wide mt-0.5">ID: FN-{{ str_pad($funcionario->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-semibold border bg-gray-950/60 text-gray-300 border-gray-800">
                                {{ $funcionario->funcao }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-semibold text-white">
                            R$ {{ number_format($funcionario->salario, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-300">
                            {{ $funcionario->data_admissao->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-semibold border bg-orange-950/40 text-orange-400 border-orange-900/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Ativo
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-1.5">
                            <a href="{{ route('funcionarios.show', $funcionario) }}"
                               class="inline-flex items-center px-2.5 py-1 bg-gray-800 hover:bg-gray-700 text-gray-300 border border-gray-700 text-[10px] font-bold rounded-lg transition-all duration-200">
                                Visualizar
                            </a>
                            <a href="{{ route('funcionarios.edit', $funcionario) }}"
                               class="inline-flex items-center px-2.5 py-1 bg-blue-950/40 hover:bg-blue-900/40 text-blue-400 border border-blue-900/30 text-[10px] font-bold rounded-lg transition-all duration-200">
                                Editar
                            </a>
                            <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Confirmar exclusão do funcionário?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2.5 py-1 bg-red-950/40 hover:bg-red-900/40 text-red-400 border border-red-900/30 text-[10px] font-bold rounded-lg transition-all duration-200 cursor-pointer">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($funcionarios->hasPages())
        <div class="px-5 py-4 border-t border-gray-800">
            {{ $funcionarios->links() }}
        </div>
        @endif
    @endif
</div>
@endsection