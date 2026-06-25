@extends('layouts.app')
@section('title', 'Editar Usuário')

@section('content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-300 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-white">Editar Usuário</h2>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800 shadow-md p-6">
        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">Nome</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->getRawAttribute('name')) }}" placeholder="Nome do usuário"
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('name') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('name')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">E-mail <span class="text-red-500">*</span></label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="exemplo@sprint.com"
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('email') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            {{-- Senha --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Nova Senha <span class="text-xs text-gray-500 font-normal">(deixe em branco para não alterar)</span></label>
                <input id="password" type="password" name="password" placeholder="Mínimo 6 caracteres"
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('password') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                @error('password')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            {{-- Confirmação de Senha --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1.5">Confirmar Nova Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Repita a nova senha"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
            </div>

            {{-- Função/Papel --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-300 mb-1.5">Função / Nível de Acesso <span class="text-red-500">*</span></label>
                <select id="role" name="role" required
                    class="w-full bg-gray-800 border rounded-lg px-3 py-2.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                           @error('role') border-red-500 bg-red-950/20 @else border-gray-700 @enderror">
                    <option value="funcionario" {{ old('role', $user->role) === 'funcionario' ? 'selected' : '' }}>Funcionário (Acesso padrão)</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrador (Acesso total)</option>
                </select>
                @error('role')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-lg text-sm transition cursor-pointer">
                    Salvar Alterações
                </button>
                <a href="{{ route('users.index') }}"
                    class="flex-1 text-center bg-gray-800 hover:bg-gray-700 text-gray-300 font-medium py-2.5 rounded-lg text-sm transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
