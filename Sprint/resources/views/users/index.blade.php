@extends('layouts.app')
@section('title', 'Usuários')

@section('content')
<div class="flex items-center justify-between mb-6 animate-fade-in-up">
    <div>
        <h2 class="text-2xl font-bold text-white font-sans">Usuários do Sistema</h2>
        <p class="text-sm text-gray-500 mt-0.5">Gerencie os usuários e suas permissões de acesso ao console da Sprint.</p>
    </div>
    <a href="{{ route('users.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold rounded-lg shadow-md hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 cursor-pointer">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Novo Usuário
    </a>
</div>

{{-- Filter and Info Bar --}}
<div class="bg-gray-900 border border-gray-800 rounded-xl p-4 mb-6 flex flex-wrap items-center justify-between gap-4 animate-fade-in-up delay-75">
    <div class="flex items-center gap-2 overflow-x-auto">
        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filtros:
        </span>
        <button class="px-3.5 py-1 text-xs font-semibold rounded-full border bg-orange-500/10 text-orange-400 border-orange-500/30">Todos</button>
    </div>
</div>

{{-- Data Card Container --}}
<div class="bg-gray-900 rounded-xl border border-gray-800 shadow-md overflow-hidden animate-fade-in-up delay-150">
    @if($users->isEmpty())
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-gray-700 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p class="text-gray-500 text-sm">Nenhum usuário cadastrado ainda.</p>
            <a href="{{ route('users.create') }}" class="mt-3 inline-block text-orange-500 text-sm hover:underline">
                Cadastrar primeiro usuário →
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-800 bg-gray-800/20 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Usuário</th>
                        <th class="px-6 py-4">Função / Nível</th>
                        <th class="px-6 py-4">Criado em</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($users as $usr)
                    <tr class="hover-row">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                {{-- Thumbnail User Icon Box --}}
                                <div class="w-10 h-10 rounded-lg bg-gray-850 border border-gray-800 flex items-center justify-center text-orange-500 flex-shrink-0 font-bold uppercase text-xs">
                                    {{ substr($usr->email, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-white text-xs">{{ $usr->email }}</p>
                                    @if(auth()->id() === $usr->id)
                                        <span class="inline-flex px-1.5 py-0.5 rounded text-[8px] font-bold bg-green-950/40 text-green-400 border border-green-900/30 uppercase mt-0.5">Sessão Atual</span>
                                    @else
                                        <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wide mt-0.5">ID: US-{{ str_pad($usr->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($usr->role === 'admin')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-semibold border bg-orange-950/40 text-orange-400 border-orange-900/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Administrador
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-semibold border bg-gray-950/60 text-gray-300 border-gray-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Funcionário
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-300">
                            {{ $usr->created_at ? $usr->created_at->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-1.5">
                            <a href="{{ route('users.edit', $usr) }}"
                               class="inline-flex items-center px-2.5 py-1 bg-blue-950/40 hover:bg-blue-900/40 text-blue-400 border border-blue-900/30 text-[10px] font-bold rounded-lg transition-all duration-200">
                                Editar
                            </a>
                            @if(auth()->id() !== $usr->id)
                                <form action="{{ route('users.destroy', $usr) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Confirmar exclusão deste usuário?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-2.5 py-1 bg-red-950/40 hover:bg-red-900/40 text-red-400 border border-red-900/30 text-[10px] font-bold rounded-lg transition-all duration-200 cursor-pointer">
                                        Excluir
                                    </button>
                                </form>
                            @else
                                <button disabled
                                        class="inline-flex items-center px-2.5 py-1 bg-gray-800 text-gray-600 border border-gray-900 text-[10px] font-bold rounded-lg cursor-not-allowed opacity-50">
                                    Excluir
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="px-5 py-4 border-t border-gray-800">
            {{ $users->links() }}
        </div>
        @endif
    @endif
</div>
@endsection
