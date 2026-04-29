@extends('layouts.master')

@section('title', 'Gastos')

@section('content')

<div class="container-fluid px-4 py-3" style="background-color: #eef3f6; min-height: 100vh;">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Gastos</h1>
            <small class="text-muted">Controle de despesas</small>
        </div>
        <a href="/" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Resumo -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Gastos Hoje</small>
                        <h3 class="fw-bold text-danger mb-0">
                            R$ {{ number_format($totalHoje, 2, ',', '.') }}
                        </h3>
                    </div>
                    <i class="bi bi-cash-stack fs-1 text-danger opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Gastos no Mês</small>
                        <h3 class="fw-bold text-danger mb-0">
                            R$ {{ number_format($totalMes, 2, ',', '.') }}
                        </h3>
                    </div>
                    <i class="bi bi-calendar-month fs-1 text-danger opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout lado a lado -->
    <div class="row g-4">

        <!-- Form -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-plus-circle"></i> Novo gasto
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="/gastos">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <input type="text" name="descricao" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Valor</label>
                            <input type="number" step="0.01" name="valor" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" name="data" class="form-control" required>
                        </div>

                        <button class="btn btn-danger w-100 fw-semibold">
                            <i class="bi bi-save"></i> Registrar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabela -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-clock-history"></i> Histórico
                    </h5>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead style="background-color: #e2e8f0;">
                                <tr>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($gastos as $g)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($g->data)->format('d/m/Y') }}</td>
                                    <td>{{ $g->descricao }}</td>
                                    <td class="fw-semibold text-danger">
                                        R$ {{ number_format($g->valor, 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Nenhum gasto registrado.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
