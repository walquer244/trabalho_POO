@extends('layouts.app')
@section('title', 'Clientes')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Lista de Clientes</h2>
        <p class="text-sm text-gray-500 mt-0.5">{{ $clientes->total() }} cliente(s) cadastrado(s)</p>
    </div>
    <a href="{{ route('clientes.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Novo Cliente
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    @if($clientes->isEmpty())
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p class="text-gray-400 text-sm">Nenhum cliente cadastrado ainda.</p>
            <a href="{{ route('clientes.create') }}" class="mt-3 inline-block text-orange-500 text-sm hover:underline">
                Cadastrar primeiro cliente →
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Idade</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Compras</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Desconto</th>
                        <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($clientes as $cliente)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400">{{ $cliente->id }}</td>
                        <td class="px-5 py-3.5 font-medium text-gray-800">{{ $cliente->nome }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $cliente->idade }} anos</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                {{ $cliente->quantidade_compras }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($cliente->desconto > 0)
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    {{ number_format($cliente->desconto, 2, ',', '.') }}%
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">Sem desconto</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-right space-x-2">
                            <a href="{{ route('clientes.edit', $cliente) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-medium rounded-lg transition">
                                Editar
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Confirmar exclusão do cliente?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-medium rounded-lg transition">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($clientes->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $clientes->links() }}
        </div>
        @endif
    @endif
</div>
@endsection