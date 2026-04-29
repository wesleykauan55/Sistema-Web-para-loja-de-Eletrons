@extends('layouts.master')

@section('title', 'Estoque')

@section('content')

<div class="container-fluid px-4 py-3" style="background-color: #eef3f6; min-height: 100vh;">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Estoque</h1>
            <small class="text-muted">Controle de produtos</small>
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

    <!-- Layout -->
    <div class="row g-4">

        <!-- Form -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-plus-circle"></i> Novo produto
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="/produtos">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nome do Produto</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantidade</label>
                            <input type="number" name="quantidade" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Preço</label>
                            <input type="number" step="0.01" name="preco" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100 fw-semibold">
                            <i class="bi bi-save"></i> Cadastrar
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
                        <i class="bi bi-box"></i> Produtos cadastrados
                    </h5>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead style="background-color: #e2e8f0;">
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($produtos as $p)
                                <tr>
                                    <td class="fw-semibold">{{ $p->nome }}</td>
                                    <td>{{ $p->quantidade }}</td>
                                    <td class="text-primary fw-semibold">
                                        R$ {{ number_format($p->preco, 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Nenhum produto cadastrado.
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
