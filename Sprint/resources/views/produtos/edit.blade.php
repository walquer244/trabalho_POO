@extends('layouts.app')
@section('title', 'Editar Produto')

@section('content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('produtos.index') }}" class="text-gray-400 hover:text-gray-300 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-white">Editar Produto</h2>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800 shadow-md p-6">
        <form action="{{ route('produtos.update', $produto) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-300 mb-1.5">Nome <span class="text-red-500">*</span></label>
                <input id="nome" type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('nome') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('nome')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="valor" class="block text-sm font-medium text-gray-300 mb-1.5">Valor (R$) <span class="text-red-500">*</span></label>
                <input id="valor" type="number" name="valor" value="{{ old('valor', $produto->valor) }}" step="0.01" min="0.01" required
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('valor') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('valor')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="cor" class="block text-sm font-medium text-gray-300 mb-1.5">Cor <span class="text-red-500">*</span></label>
                <input id="cor" type="text" name="cor" value="{{ old('cor', $produto->cor) }}" required
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('cor') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('cor')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="quantidade_estoque" class="block text-sm font-medium text-gray-300 mb-1.5">Quantidade em Estoque <span class="text-red-500">*</span></label>
                <input id="quantidade_estoque" type="number" name="quantidade_estoque" value="{{ old('quantidade_estoque', $produto->quantidade_estoque) }}" min="0" required
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('quantidade_estoque') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('quantidade_estoque')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-lg text-sm transition cursor-pointer">
                    Salvar Alterações
                </button>
                <a href="{{ route('produtos.index') }}"
                    class="flex-1 text-center bg-gray-800 hover:bg-gray-700 text-gray-300 font-medium py-2.5 rounded-lg text-sm transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection