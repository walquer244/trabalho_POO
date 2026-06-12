@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Usuários do Sistema</h1>
            <p class="text-slate-400 text-sm mt-1">Gerencie os acessos ao painel administrativo</p>
        </div>
        <a href="{{ route('usuarios.create') }}" id="btn-novo-usuario"
           class="mt-4 sm:mt-0 inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold py-2.5 px-5 rounded-xl text-sm transition shadow-lg shadow-emerald-600/15">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Adicionar Usuário
        </a>
    </div>

    @include('layouts.alerts')

    <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-900/60 border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">#</th>
                        <th class="py-4 px-6">Nome</th>
                        <th class="py-4 px-6">E-mail</th>
                        <th class="py-4 px-6">Nível de Acesso</th>
                        <th class="py-4 px-6">Cadastro</th>
                        <th class="py-4 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @forelse($usuarios as $u)
                        <tr class="hover:bg-slate-900/30 transition-colors">
                            <td class="py-4 px-6 text-slate-500 font-mono text-xs">#{{ $u->id }}</td>
                            <td class="py-4 px-6 font-bold text-white">
                                {{ $u->nome }}
                                @if($u->id === session('user_id'))
                                    <span class="ml-2 text-[10px] font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-1.5 py-0.5 rounded-full">você</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-400">{{ $u->email }}</td>
                            <td class="py-4 px-6">
                                @if($u->nivel_acesso === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                        Funcionário
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-400">{{ \Carbon\Carbon::parse($u->data_cadastro)->format('d/m/Y') }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('usuarios.edit', $u->id) }}"
                                       id="btn-edit-usuario-{{ $u->id }}" title="Editar"
                                       class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl border border-transparent hover:border-slate-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    @if($u->id !== session('user_id'))
                                        <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST"
                                              onsubmit="return confirm('Deseja realmente excluir este usuário?')" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="btn-delete-usuario-{{ $u->id }}" title="Excluir"
                                                    class="p-2 text-rose-500 hover:text-rose-400 hover:bg-rose-950/20 rounded-xl border border-transparent hover:border-rose-500/20 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-slate-500">
                                Nenhum usuário cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
