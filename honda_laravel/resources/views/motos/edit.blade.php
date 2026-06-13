@include('includes.header')

<div class="space-y-6">

    <!-- Cabeçalho -->
    <div class="flex items-center justify-between pb-5 border-b border-slate-800/80">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Editar Moto</h1>
            <p class="text-slate-400 text-sm mt-1">Atualize as informações da moto #{{ $id }}</p>
        </div>
        <a href="list.php"
           class="inline-flex items-center bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-4 border border-slate-700 rounded-xl text-sm transition">
            ← Voltar
        </a>
    </div>

    <!-- Alerta de Erro -->
    @if (!empty($error))
        <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-2xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span>{{ $error }}</span>
        </div>
    @endif

    <!-- Formulário de Edição -->
    <div class="max-w-2xl bg-slate-900/40 border border-slate-800/80 p-8 rounded-3xl shadow-xl">
        <form action="edit.php?id={{ $id }}" method="POST" id="form-edit-moto-{{ $id }}" class="space-y-6">
            @csrf

            <!-- Marca e Modelo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="marca" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Marca <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="marca" id="marca" required
                           placeholder="Ex: Honda, Yamaha, Suzuki..."
                           value="{{ request('marca', $moto->marca) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
                <div>
                    <label for="modelo" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Modelo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="modelo" id="modelo" required
                           placeholder="Ex: CG 160, CB 500, Biz..."
                           value="{{ request('modelo', $moto->modelo) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
            </div>

            <!-- Cor e Ano de Fabricação -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="cor" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Cor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="cor" id="cor" required
                           placeholder="Ex: Preto, Vermelho, Azul..."
                           value="{{ request('cor', $moto->cor) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
                <div>
                    <label for="ano" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                        Ano de Fabricação <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="ano" id="ano" required min="1900" max="{{ date('Y') + 1 }}"
                           value="{{ request('ano', $moto->ano) }}"
                           class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
                </div>
            </div>

            <!-- Valor -->
            <div>
                <label for="valor" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    Valor (R$) <span class="text-red-500">*</span>
                </label>
                <input type="number" step="0.01" name="valor" id="valor" required min="0.01"
                       value="{{ request('valor', $moto->valor) }}"
                       class="w-full bg-slate-950/60 border border-slate-800 hover:border-slate-700 focus:border-red-500 rounded-xl py-3 px-4 text-slate-200 placeholder-slate-600 focus:outline-none transition text-sm">
            </div>

            <!-- Botões -->
            <div class="flex items-center space-x-3 pt-4 border-t border-slate-800/80">
                <button type="submit" id="btn-atualizar-moto"
                        class="bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold py-2.5 px-6 rounded-xl transition text-sm shadow-lg shadow-red-600/15">
                    Atualizar Moto
                </button>
                <a href="list.php"
                   class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold py-2.5 px-6 border border-slate-700 rounded-xl transition text-sm">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</div>

@include('includes.footer')
