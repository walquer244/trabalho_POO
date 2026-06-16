@extends('layouts.app')
@section('title', 'Produtos')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Lista de Produtos</h2>
        <p class="text-sm text-gray-500 mt-0.5">{{ $produtos->total() }} produto(s) cadastrado(s)</p>
    </div>
    <a href="{{ route('produtos.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Novo Produto
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    @if($produtos->isEmpty())
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p class="text-gray-400 text-sm">Nenhum produto cadastrado ainda.</p>
            <a href="{{ route('produtos.create') }}" class="mt-3 inline-block text-orange-500 text-sm hover:underline">
                Cadastrar primeiro produto →
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Valor</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Cor</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Estoque</th>
                        <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($produtos as $produto)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400">{{ $produto->id }}</td>
                        <td class="px-5 py-3.5 font-medium text-gray-800">{{ $produto->nome }}</td>
                        <td class="px-5 py-3.5 text-gray-600">R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1.5 text-gray-600">
                                {{ $produto->cor }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $produto->quantidade_estoque > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $produto->quantidade_estoque }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-right space-x-2">
                            <a href="{{ route('produtos.edit', $produto) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-medium rounded-lg transition">
                                Editar
                            </a>
                            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Confirmar exclusão do produto?')">
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

        @if($produtos->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $produtos->links() }}
        </div>
        @endif
    @endif
</div>
@endsection