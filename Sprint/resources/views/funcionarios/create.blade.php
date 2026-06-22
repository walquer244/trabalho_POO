@extends('layouts.app')
@section('title', 'Novo Funcionário')

@section('content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('funcionarios.index') }}" class="text-gray-400 hover:text-gray-300 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-white">Cadastrar Funcionário</h2>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800 shadow-md p-6">
        <form action="{{ route('funcionarios.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-300 mb-1.5">Nome <span class="text-red-500">*</span></label>
                <input id="nome" type="text" name="nome" value="{{ old('nome') }}" required placeholder="Nome completo"
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('nome') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('nome')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-300 mb-1.5">Data de Nascimento <span class="text-red-500">*</span></label>
                    <input id="data_nascimento" type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" required
                        class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                               @error('data_nascimento') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                    @error('data_nascimento')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="data_admissao" class="block text-sm font-medium text-gray-300 mb-1.5">Data de Admissão <span class="text-red-500">*</span></label>
                    <input id="data_admissao" type="date" name="data_admissao" value="{{ old('data_admissao') }}" required
                        class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                               @error('data_admissao') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                    @error('data_admissao')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="funcao" class="block text-sm font-medium text-gray-300 mb-1.5">Função <span class="text-red-500">*</span></label>
                <input id="funcao" type="text" name="funcao" value="{{ old('funcao') }}" required placeholder="Ex: Vendedor, Gerente..."
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('funcao') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('funcao')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="salario" class="block text-sm font-medium text-gray-300 mb-1.5">Salário (R$) <span class="text-red-500">*</span></label>
                <input id="salario" type="number" name="salario" value="{{ old('salario') }}" step="0.01" min="0.01" required placeholder="0.00"
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('salario') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('salario')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-lg text-sm transition cursor-pointer">
                    Salvar Funcionário
                </button>
                <a href="{{ route('funcionarios.index') }}"
                    class="flex-1 text-center bg-gray-800 hover:bg-gray-700 text-gray-300 font-medium py-2.5 rounded-lg text-sm transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection