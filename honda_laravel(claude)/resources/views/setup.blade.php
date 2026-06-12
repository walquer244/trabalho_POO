<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação — Honda Concessionária</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-800 rounded-2xl shadow-xl border border-slate-700 p-8">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-600 flex items-center justify-center text-white font-bold text-xl">H</div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Honda Concessionária</h1>
                <p class="text-slate-400 text-sm font-medium">Instalador & Setup do Sistema</p>
            </div>
        </div>

        <div class="p-4 rounded-xl {{ $success ? 'bg-emerald-950/50 border border-emerald-500/30 text-emerald-300' : 'bg-rose-950/50 border border-rose-500/30 text-rose-300' }} mb-6 text-sm leading-relaxed">
            {!! $message !!}
        </div>

        @if($success)
            <div class="space-y-4">
                <a href="{{ route('login') }}"
                   class="w-full block text-center bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold py-3 px-4 rounded-xl transition duration-150 shadow-lg shadow-red-600/20">
                    Ir para o Login
                </a>
                <p class="text-xs text-center text-slate-400 leading-normal">
                    Credenciais padrão:<br>
                    <strong>admin@honda.com.br</strong> (senha: <code>admin123</code>)<br>
                    <strong>vendedor@honda.com.br</strong> (senha: <code>venda123</code>)
                </p>
            </div>
        @else
            <a href="{{ route('setup') }}"
               class="w-full block text-center bg-slate-700 hover:bg-slate-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-150">
                Tentar Novamente
            </a>
        @endif
    </div>
</body>
</html>
