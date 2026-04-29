@extends('layouts.master')

@section('title', 'Home')

@section('content')

<div class="container-fluid px-4 py-3" style="background-color: #eef3f6; min-height: 100vh;">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Sistema da Loja</h1>
            <small class="text-muted">Painel principal</small>
        </div>

        <div class="d-flex align-items-center gap-3">
            <strong>👋 {{ auth()->user()->name }}</strong>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </button>
            </form>
        </div>
    </div>

    <!-- MENU PRINCIPAL -->
    <div class="row g-4">

        <!-- ATENDIMENTOS -->
        <div class="col-md-6 col-lg-3">
            <a href="/atendimentos" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 text-center p-4 hover-card">
                    <h5 class="fw-semibold mb-2">💰 Atendimentos</h5>
                    <p class="text-muted mb-0">Registrar entradas</p>
                </div>
            </a>
        </div>

        <!-- GASTOS -->
        <div class="col-md-6 col-lg-3">
            <a href="/gastos" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 text-center p-4 hover-card">
                    <h5 class="fw-semibold mb-2">💸 Gastos</h5>
                    <p class="text-muted mb-0">Controlar saídas</p>
                </div>
            </a>
        </div>

        <!-- ESTOQUE -->
        <div class="col-md-6 col-lg-3">
            <a href="/produtos" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 text-center p-4 hover-card">
                    <h5 class="fw-semibold mb-2">📦 Estoque</h5>
                    <p class="text-muted mb-0">Gerenciar produtos</p>
                </div>
            </a>
        </div>

        <!-- ADMIN -->
        @if(auth()->user()->tipo === 'admin')
        <div class="col-md-6 col-lg-3">
            <a href="/dashboard" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 text-center p-4 hover-card">
                    <h5 class="fw-semibold mb-2">🔒 Admin</h5>
                    <p class="text-muted mb-0">Painel administrativo</p>
                </div>
            </a>
        </div>
        @endif

    </div>

</div>

<!-- HOVER BONITO -->
<style>
.hover-card {
    transition: 0.2s;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
</style>

@endsection