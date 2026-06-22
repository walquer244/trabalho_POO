@extends('layouts.app')
@section('title', 'Detalhes do Funcionário')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('funcionarios.index') }}" class="text-gray-400 hover:text-gray-300 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-white">Detalhes do Funcionário</h2>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800 shadow-md p-6 space-y-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <p class="text-sm text-gray-400">Nome</p>
                <p class="mt-1 text-base font-medium text-white">{{ $funcionario->nome }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Função</p>
                <p class="mt-1 text-base font-medium text-white">{{ $funcionario->funcao }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Data de Nascimento</p>
                <p class="mt-1 text-base font-medium text-white">{{ $funcionario->data_nascimento->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Data de Admissão</p>
                <p class="mt-1 text-base font-medium text-white">{{ $funcionario->data_admissao->format('d/m/Y') }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm text-gray-400">Salário</p>
                <p class="mt-1 text-base font-medium text-white">R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('funcionarios.edit', $funcionario) }}"
               class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg text-sm transition">
                Editar
            </a>
            <a href="{{ route('funcionarios.index') }}"
               class="flex-1 text-center bg-gray-800 hover:bg-gray-700 text-gray-300 font-semibold py-2.5 rounded-lg text-sm transition">
                Voltar à lista
            </a>
        </div>
    </div>
</div>
@endsection
