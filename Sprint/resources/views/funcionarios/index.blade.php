@extends('layouts.app')
@section('title', 'Funcionários')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Lista de Funcionários</h2>
        <p class="text-sm text-gray-500 mt-0.5">{{ $funcionarios->total() }} funcionário(s) cadastrado(s)</p>
    </div>
    <a href="{{ route('funcionarios.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Novo Funcionário
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    @if($funcionarios->isEmpty())
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-gray-400 text-sm">Nenhum funcionário cadastrado ainda.</p>
            <a href="{{ route('funcionarios.create') }}" class="mt-3 inline-block text-orange-500 text-sm hover:underline">
                Cadastrar primeiro funcionário →
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Função</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Salário</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admissão</th>
                        <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($funcionarios as $funcionario)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400">{{ $funcionario->id }}</td>
                        <td class="px-5 py-3.5 font-medium text-gray-800">{{ $funcionario->nome }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $funcionario->funcao }}</td>
                        <td class="px-5 py-3.5 text-gray-600">R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $funcionario->data_admissao->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5 text-right space-x-2">
                            <a href="{{ route('funcionarios.edit', $funcionario) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-medium rounded-lg transition">
                                Editar
                            </a>
                            <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Confirmar exclusão do funcionário?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-medium rounded-lg transition">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($funcionarios->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $funcionarios->links() }}
        </div>
        @endif
    @endif
</div>
@endsection