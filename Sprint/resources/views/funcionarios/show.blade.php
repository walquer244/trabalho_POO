@extends('layouts.app')
@section('title', 'Detalhes do Funcionário')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('funcionarios.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-gray-800">Detalhes do Funcionário</h2>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <p class="text-sm text-gray-500">Nome</p>
                <p class="mt-1 text-base font-medium text-gray-900">{{ $funcionario->nome }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Função</p>
                <p class="mt-1 text-base font-medium text-gray-900">{{ $funcionario->funcao }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Data de Nascimento</p>
                <p class="mt-1 text-base font-medium text-gray-900">{{ $funcionario->data_nascimento->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Data de Admissão</p>
                <p class="mt-1 text-base font-medium text-gray-900">{{ $funcionario->data_admissao->format('d/m/Y') }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm text-gray-500">Salário</p>
                <p class="mt-1 text-base font-medium text-gray-900">R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('funcionarios.edit', $funcionario) }}"
               class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg text-sm transition">
                Editar
            </a>
            <a href="{{ route('funcionarios.index') }}"
               class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition">
                Voltar à lista
            </a>
        </div>
    </div>
</div>
@endsection
