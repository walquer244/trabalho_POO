@extends('layouts.app')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Cadastrar Usuário</h1>
            <p class="text-slate-400 text-sm mt-1">Adicione um novo usuário ao sistema</p>
        </div>
        <a href="{{ route('usuarios.index') }}"
           class="inline-flex items-center bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-4 border border-slate-700 rounded-xl text-sm transition">
            ← Voltar
        </a>
    </div>

    @include('layouts.alerts')

    <div class="max-w-2xl bg-slate-900/40 border border-slate-800/80 p-8 rounded-3xl shadow-xl">
        <form action="{{ route('usuarios.store') }}" method="POST" id="form-create-usuario" class="space-y-6">
            @csrf

            <div>
                <label for="nome" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    Nome Completo <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nome" id="nome" required
                       placeholder="Ex: João da Silva"
                       value="{{ old('nome') }}"
                       class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-emerald-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    E-mail <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" required
                       placeholder="joao@honda.com.br"
                       value="{{ old('email') }}"
                       class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-emerald-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
            </div>

            <div>
                <label for="senha" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    Senha <span class="text-red-500">*</span>
                </label>
                <input type="password" name="senha" id="senha" required minlength="6"
                       placeholder="Mínimo 6 caracteres"
                       class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-emerald-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
            </div>

            <div>
                <label for="nivel_acesso" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    Nível de Acesso <span class="text-red-500">*</span>
                </label>
                <select name="nivel_acesso" id="nivel_acesso" required
                        class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-emerald-500 rounded-xl py-3 px-4 text-slate-200 focus:outline-none transition text-sm">
                    <option value="funcionario" {{ old('nivel_acesso') === 'funcionario' ? 'selected' : '' }}>Funcionário</option>
                    <option value="admin" {{ old('nivel_acesso') === 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div class="flex items-center space-x-3 pt-4 border-t border-slate-800/80">
                <button type="submit" id="btn-salvar-usuario"
                        class="bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold py-2.5 px-6 rounded-xl transition text-sm shadow-lg shadow-emerald-600/15">
                    Salvar Usuário
                </button>
                <a href="{{ route('usuarios.index') }}"
                   class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-6 border border-slate-700 rounded-xl transition text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
