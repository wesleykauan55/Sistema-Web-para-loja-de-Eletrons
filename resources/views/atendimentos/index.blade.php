@extends('layouts.master')


@section('title', 'Atendimentos')


@section('content')
<div class="container-fluid px-4 py-3" style="background-color: #eef3f6; min-height: 100vh;">


    <!-- Navegação + título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Atendimentos</h1>
            <small class="text-muted">Controle de vendas e serviços</small>
        </div>
        <a href="/" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>


    <!-- Alertas -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <!-- Cards resumo -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Hoje</small>
                        <h3 class="fw-bold text-primary mb-0">
                            R$ {{ number_format($totalHoje, 2, ',', '.') }}
                        </h3>
                    </div>
                    <i class="bi bi-calendar-day fs-1 text-primary opacity-25"></i>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total no Mês</small>
                        <h3 class="fw-bold text-success mb-0">
                            R$ {{ number_format($totalMes, 2, ',', '.') }}
                        </h3>
                    </div>
                    <i class="bi bi-calendar-month fs-1 text-success opacity-25"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Form + tabela lado a lado -->
    <div class="row g-4">


        <!-- Formulário -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-plus-circle"></i> Novo atendimento
                    </h5>
                </div>


                <div class="card-body">
                    <form method="POST" action="/atendimentos">
                        @csrf


                        <div class="mb-3">
                            <label class="form-label">Tipo *</label>
                            <select name="tipo" class="form-select" required>
                                <option value="">Selecione...</option>
                                <option>Venda de celular</option>
                                <option>Conserto de celular</option>
                                <option>Venda de chip</option>
                                <option>Cadastro de chip</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Valor (R$) *</label>
                            <input type="number" step="0.01" name="valor" class="form-control" placeholder="0,00" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Data *</label>
                            <input type="date" name="data" class="form-control" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Observação</label>
                            <textarea name="observacao" rows="3" class="form-control"></textarea>
                        </div>


                        <button class="btn btn-primary w-100 fw-semibold">
                            <i class="bi bi-save"></i> Salvar
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
                            <thead style="background-color: #f1f5f9;">
                                <tr>
                                    <th>Data</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>


                            <tbody>
                                @forelse($atendimentos as $a)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($a->data)->format('d/m/Y') }}</td>
                                    <td>{{ $a->tipo }}</td>
                                    <td class="fw-semibold text-success">
                                        R$ {{ number_format($a->valor, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $a->observacao ?: '—' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Nenhum atendimento registrado.
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
