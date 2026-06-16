@extends('layouts.app')
@section('title', 'Editar Cliente')

@section('content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('clientes.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-gray-800">Editar Cliente</h2>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1.5">Nome <span class="text-red-500">*</span></label>
                <input id="nome" type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" required
                    class="w-full border rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('nome') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                @error('nome')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="idade" class="block text-sm font-medium text-gray-700 mb-1.5">Idade <span class="text-red-500">*</span></label>
                <input id="idade" type="number" name="idade" value="{{ old('idade', $cliente->idade) }}" required min="1" max="120"
                    class="w-full border rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('idade') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                @error('idade')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="quantidade_compras" class="block text-sm font-medium text-gray-700 mb-1.5">Quantidade de Compras <span class="text-red-500">*</span></label>
                <input id="quantidade_compras" type="number" name="quantidade_compras" value="{{ old('quantidade_compras', $cliente->quantidade_compras) }}" required min="0"
                    class="w-full border rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('quantidade_compras') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                @error('quantidade_compras')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="desconto" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Desconto (%) <span class="text-red-500">*</span>
                    <span class="text-gray-400 font-normal ml-1">— Entre 0 e 100</span>
                </label>
                <input id="desconto" type="number" name="desconto" value="{{ old('desconto', $cliente->desconto) }}" required min="0" max="100" step="0.01"
                    class="w-full border rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('desconto') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                @error('desconto')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-lg text-sm transition">
                    Salvar Alterações
                </button>
                <a href="{{ route('clientes.index') }}"
                    class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection