@extends('layouts.app')

@section('title', 'Editar Funcionário')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Editar Funcionário</h1>
            <p class="text-slate-400 text-sm mt-1">Atualize os dados do funcionário #{{ $funcionario->id }}</p>
        </div>
        <a href="{{ route('funcionarios.index') }}"
           class="inline-flex items-center bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-4 border border-slate-700 rounded-xl text-sm transition">
            ← Voltar
        </a>
    </div>

    @include('layouts.alerts')

    <div class="max-w-2xl bg-slate-900/40 border border-slate-800/80 p-8 rounded-3xl shadow-xl">
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST" id="form-edit-funcionario-{{ $funcionario->id }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label for="nome" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Nome Completo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nome" id="nome" required
                           value="{{ old('nome', $funcionario->nome) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-purple-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="funcao" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Função <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="funcao" id="funcao" required
                           value="{{ old('funcao', $funcionario->funcao) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-purple-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>

                <div>
                    <label for="data_admissao" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Data de Admissão <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="data_admissao" id="data_admissao" required
                           value="{{ old('data_admissao', $funcionario->data_admissao) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-purple-500 rounded-xl py-3 px-4 text-slate-200 focus:outline-none transition text-sm">
                </div>

                <div>
                    <label for="data_nascimento" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Data de Nascimento <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required
                           value="{{ old('data_nascimento', $funcionario->data_nascimento) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-purple-500 rounded-xl py-3 px-4 text-slate-200 focus:outline-none transition text-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="salario" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Salário (R$) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="salario" id="salario" required min="0.01"
                           value="{{ old('salario', $funcionario->salario) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-purple-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
            </div>

            <div class="flex items-center space-x-3 pt-4 border-t border-slate-800/80">
                <button type="submit" id="btn-atualizar-funcionario"
                        class="bg-purple-600 hover:bg-purple-700 active:bg-purple-800 text-white font-semibold py-2.5 px-6 rounded-xl transition text-sm shadow-lg shadow-purple-600/15">
                    Atualizar Funcionário
                </button>
                <a href="{{ route('funcionarios.index') }}"
                   class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-6 border border-slate-700 rounded-xl transition text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
