@extends('layouts.app')

@section('title', 'Estoque de Motos')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Estoque de Motos</h1>
            <p class="text-slate-400 text-sm mt-1">Gerencie as motocicletas cadastradas no inventário</p>
        </div>
        <a href="{{ route('motos.create') }}" id="btn-nova-moto"
           class="mt-4 sm:mt-0 inline-flex items-center justify-center bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold py-2.5 px-5 rounded-xl text-sm transition shadow-lg shadow-amber-600/15">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Adicionar Moto
        </a>
    </div>

    @include('layouts.alerts')

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
                    @forelse($motos as $moto)
                        <tr class="hover:bg-slate-900/30 transition-colors">
                            <td class="py-4 px-6 text-slate-500 font-mono text-xs">#{{ $moto->id }}</td>
                            <td class="py-4 px-6 font-bold text-white">{{ $moto->marca }}</td>
                            <td class="py-4 px-6 text-slate-300">{{ $moto->modelo }}</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                    {{ $moto->cor }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-400 font-medium">{{ $moto->ano }}</td>
                            <td class="py-4 px-6 font-bold text-amber-400">R$ {{ number_format($moto->valor, 2, ',', '.') }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('motos.edit', $moto->id) }}"
                                       id="btn-edit-moto-{{ $moto->id }}" title="Editar"
                                       class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl border border-transparent hover:border-slate-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('motos.destroy', $moto->id) }}" method="POST"
                                          onsubmit="return confirm('Deseja realmente excluir esta moto?')" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="btn-delete-moto-{{ $moto->id }}" title="Excluir"
                                                class="p-2 text-rose-500 hover:text-rose-400 hover:bg-rose-950/20 rounded-xl border border-transparent hover:border-rose-500/20 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-slate-500">
                                Nenhuma moto cadastrada. <a href="{{ route('motos.create') }}" class="text-amber-400 hover:underline">Adicionar a primeira.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
