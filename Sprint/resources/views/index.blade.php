@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

    {{-- Card Produtos --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 flex items-center gap-4 shadow-sm">
        <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalProdutos) }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Produtos cadastrados</p>
        </div>
    </div>

    {{-- Card Funcionários --}}
    @if(auth()->user()->isAdmin())
    <div class="bg-white rounded-xl border border-gray-200 p-6 flex items-center gap-4 shadow-sm">
        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalFuncionarios) }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Funcionários cadastrados</p>
        </div>
    </div>
    @endif

    {{-- Card Clientes --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 flex items-center gap-4 shadow-sm">
        <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalClientes) }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Clientes cadastrados</p>
        </div>
    </div>
</div>

{{-- Atalhos rápidos --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
    <h2 class="text-sm font-semibold text-gray-700 mb-4">Ações rápidas</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('produtos.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Novo Produto
        </a>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('funcionarios.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Novo Funcionário
        </a>
        @endif
        <a href="{{ route('clientes.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Novo Cliente
        </a>
    </div>
</div>
@endsection