@extends('layouts.app')

@section('title', 'Cadastrar Moto')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Cadastrar Moto</h1>
            <p class="text-slate-400 text-sm mt-1">Adicione uma nova moto ao inventário</p>
        </div>
        <a href="{{ route('motos.index') }}"
           class="inline-flex items-center bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-4 border border-slate-700 rounded-xl text-sm transition">
            ← Voltar
        </a>
    </div>

    @include('layouts.alerts')

    <div class="max-w-2xl bg-slate-900/40 border border-slate-800/80 p-8 rounded-3xl shadow-xl">
        <form action="{{ route('motos.store') }}" method="POST" id="form-create-moto" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="marca" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Marca <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="marca" id="marca" required
                           placeholder="Ex: Honda, Yamaha, Kawasaki..."
                           value="{{ old('marca') }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-amber-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
                <div>
                    <label for="modelo" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Modelo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="modelo" id="modelo" required
                           placeholder="Ex: CB 500, MT-07, Ninja..."
                           value="{{ old('modelo') }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-amber-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="cor" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Cor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="cor" id="cor" required
                           placeholder="Ex: Preto, Vermelho, Azul..."
                           value="{{ old('cor') }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-amber-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
                <div>
                    <label for="ano" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Ano de Fabricação <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="ano" id="ano" required
                           min="1900" max="{{ date('Y') + 1 }}"
                           placeholder="{{ date('Y') }}"
                           value="{{ old('ano', date('Y')) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-amber-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
            </div>

            <div>
                <label for="valor" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    Valor (R$) <span class="text-red-500">*</span>
                </label>
                <input type="number" step="0.01" name="valor" id="valor" required min="0.01"
                       placeholder="Ex: 35000.00"
                       value="{{ old('valor') }}"
                       class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-amber-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
            </div>

            <div class="flex items-center space-x-3 pt-4 border-t border-slate-800/80">
                <button type="submit" id="btn-salvar-moto"
                        class="bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold py-2.5 px-6 rounded-xl transition text-sm shadow-lg shadow-amber-600/15">
                    Salvar Moto
                </button>
                <a href="{{ route('motos.index') }}"
                   class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-6 border border-slate-700 rounded-xl transition text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
