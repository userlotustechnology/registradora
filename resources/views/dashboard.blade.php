@extends('layouts.main')

@section('title', 'Dashboard - Registradora de Valores')

@section('content')
<!-- Cards de Estatísticas -->
<div class="card bg-white p-20 rounded-10 border border-white mb-4 py-50">
    <div class="row">
        <!-- Total de Clientes -->
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative border-end-custom pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10 fs-15">Total de Clientes</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">{{ number_format($stats['total_customers'], 0, ',', '.') }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-symbols-outlined fs-48 text-primary">people</i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="d-flex align-content-center gap-1 bg-success bg-opacity-10 border border-success" style="padding: 3px 5px;">
                        <i class="material-symbols-outlined fs-14 text-success">add</i>
                        <span class="lh-1 fs-14 text-success">{{ $stats['new_customers_month'] }}</span>
                    </span>
                    <p class="mb-0 fs-14 pe-3 d-block" style="margin-top: 2px;">Novos este mês</p>
                </div>
            </div>
        </div>

        <!-- Total de Transações -->
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative border-end-custom pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10 fs-15">Total de Transações</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">{{ number_format($stats['total_transactions'], 0, ',', '.') }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-symbols-outlined fs-48 text-info">receipt_long</i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="d-flex align-content-center gap-1 bg-info bg-opacity-10 border border-info" style="padding: 3px 5px;">
                        <i class="material-symbols-outlined fs-14 text-info">calendar_month</i>
                        <span class="lh-1 fs-14 text-info">{{ $stats['transactions_month'] }}</span>
                    </span>
                    <p class="mb-0 fs-14 pe-3 d-block" style="margin-top: 2px;">Este mês</p>
                </div>
            </div>
        </div>

        <!-- Saldo Disponível -->
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative border-end-custom pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10 fs-15">Saldo Disponível</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">R$ {{ number_format($stats['total_available_balance'], 2, ',', '.') }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-symbols-outlined fs-48 text-success">account_balance_wallet</i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="fs-12 text-secondary">PIX + Boleto</span>
                </div>
            </div>
        </div>

        <!-- Saldo de Crédito -->
        <div class="col-xxl-3 col-md-6 col-xxxl-6">
            <div class="position-relative pe-10">
                <div class="d-sm-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-10 fs-15">Saldo de Crédito</h3>
                        <h2 class="fs-26 fw-medium mb-0 lh-1">R$ {{ number_format($stats['total_credit_balance'], 2, ',', '.') }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-symbols-outlined fs-48 text-warning">credit_card</i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 25px;">
                    <span class="fs-12 text-secondary">Cartão de Crédito</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Segunda linha de cards -->
<div class="row mb-4">
    <!-- Créditos do Mês -->
    <div class="col-md-4">
        <div class="card bg-white p-20 rounded-10 border border-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-secondary fs-14">Créditos do Mês</p>
                    <h3 class="mb-0 fs-24 fw-bold text-success">R$ {{ number_format($stats['credits_month'], 2, ',', '.') }}</h3>
                </div>
                <div class="text-center rounded-circle bg-success bg-opacity-10" style="width: 50px; height: 50px;">
                    <i class="material-symbols-outlined fs-32 text-success" style="line-height: 50px;">trending_up</i>
                </div>
            </div>
        </div>
    </div>

    <!-- Débitos do Mês -->
    <div class="col-md-4">
        <div class="card bg-white p-20 rounded-10 border border-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-secondary fs-14">Débitos do Mês</p>
                    <h3 class="mb-0 fs-24 fw-bold text-danger">R$ {{ number_format($stats['debits_month'], 2, ',', '.') }}</h3>
                </div>
                <div class="text-center rounded-circle bg-danger bg-opacity-10" style="width: 50px; height: 50px;">
                    <i class="material-symbols-outlined fs-32 text-danger" style="line-height: 50px;">trending_down</i>
                </div>
            </div>
        </div>
    </div>

    <!-- Liberações Pendentes -->
    <div class="col-md-4">
        <div class="card bg-white p-20 rounded-10 border border-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-secondary fs-14">Liberações Pendentes</p>
                    <h3 class="mb-0 fs-24 fw-bold text-warning">{{ $stats['pending_releases'] }}</h3>
                    <small class="text-secondary">R$ {{ number_format($stats['pending_releases_amount'], 2, ',', '.') }}</small>
                </div>
                <div class="text-center rounded-circle bg-warning bg-opacity-10" style="width: 50px; height: 50px;">
                    <i class="material-symbols-outlined fs-32 text-warning" style="line-height: 50px;">schedule</i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Créditos por Tipo de Pagamento -->
    <div class="col-xxl-4 col-lg-6">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
                <h3 class="fs-18">Créditos por Tipo (Mês)</h3>
            </div>

            <ul class="p-0 mb-0 list-unstyled">
                @foreach($stats['credits_by_payment_type'] as $type => $amount)
                <li class="d-flex justify-content-between align-items-center border-border-color pb-10 mb-10" style="border-bottom: 1px dashed;">
                    <div class="d-flex align-items-center">
                        <div class="text-center rounded-circle" style="width: 40px; height: 40px; background-color: #f4f6fc;">
                            @if($type == 'pix')
                                <i class="material-symbols-outlined fs-20 text-primary" style="line-height: 40px;">pix</i>
                            @elseif($type == 'boleto')
                                <i class="material-symbols-outlined fs-20 text-warning" style="line-height: 40px;">receipt</i>
                            @elseif($type == 'cartao_credito')
                                <i class="material-symbols-outlined fs-20 text-info" style="line-height: 40px;">credit_card</i>
                            @else
                                <i class="material-symbols-outlined fs-20 text-secondary" style="line-height: 40px;">payments</i>
                            @endif
                        </div>
                        <span class="ms-12 fs-14 text-secondary fw-medium text-capitalize">
                            {{ str_replace('_', ' ', $type ?? 'N/A') }}
                        </span>
                    </div>
                    <span class="fs-14 fw-semibold">R$ {{ number_format($amount, 2, ',', '.') }}</span>
                </li>
                @endforeach
                
                @if(empty($stats['credits_by_payment_type']))
                <li class="text-center text-secondary py-3">
                    <i class="material-symbols-outlined fs-48 d-block mb-2">inbox</i>
                    Nenhum crédito registrado este mês
                </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Top 5 Clientes por Saldo -->
    <div class="col-xxl-4 col-lg-6">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
                <h3 class="fs-18">Top 5 Clientes</h3>
            </div>

            <ul class="p-0 mb-0 list-unstyled">
                @foreach($topCustomers as $customer)
                <li class="d-flex justify-content-between align-items-center border-border-color pb-10 mb-10" style="border-bottom: 1px dashed;">
                    <div class="d-flex align-items-center flex-grow-1">
                        <div class="text-center rounded-circle bg-primary bg-opacity-10" style="width: 40px; height: 40px; min-width: 40px;">
                            <span class="fw-bold text-primary" style="line-height: 40px;">{{ substr($customer->name, 0, 1) }}</span>
                        </div>
                        <div class="ms-12 flex-grow-1">
                            <span class="fs-14 text-secondary fw-medium d-block">{{ Str::limit($customer->name, 20) }}</span>
                            <small class="text-muted">{{ $customer->document }}</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fs-14 fw-semibold d-block">R$ {{ number_format($customer->total_balance, 2, ',', '.') }}</span>
                        <small class="text-success">Disp: {{ number_format($customer->available_balance, 2, ',', '.') }}</small>
                    </div>
                </li>
                @endforeach
                
                @if($topCustomers->isEmpty())
                <li class="text-center text-secondary py-3">
                    <i class="material-symbols-outlined fs-48 d-block mb-2">person_off</i>
                    Nenhum cliente cadastrado
                </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Transações Recentes -->
    <div class="col-xxl-4 col-lg-12">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
                <h3 class="fs-18">Transações Recentes</h3>
            </div>

            <div class="default-table-area without-header" style="max-height: 400px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="text-center rounded-circle {{ $transaction->transaction_type == 'credit' ? 'bg-success' : 'bg-danger' }} bg-opacity-10" style="width: 35px; height: 35px; min-width: 35px;">
                                            <i class="material-symbols-outlined fs-18 {{ $transaction->transaction_type == 'credit' ? 'text-success' : 'text-danger' }}" style="line-height: 35px;">
                                                {{ $transaction->transaction_type == 'credit' ? 'add' : 'remove' }}
                                            </i>
                                        </div>
                                        <div class="ms-10">
                                            <h6 class="mb-0 fs-14 fw-medium">{{ Str::limit($transaction->endCustomer->name ?? 'N/A', 25) }}</h6>
                                            <span class="fs-12 text-secondary">
                                                {{ ucfirst($transaction->transaction_type) }} 
                                                @if($transaction->payment_type)
                                                - {{ str_replace('_', ' ', $transaction->payment_type) }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-semibold fs-14 {{ $transaction->transaction_type == 'credit' ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->transaction_type == 'credit' ? '+' : '-' }}R$ {{ number_format($transaction->total_amount, 2, ',', '.') }}
                                    </span>
                                    <br>
                                    <small class="text-secondary">{{ $transaction->created_at->format('d/m/Y H:i') }}</small>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if($recentTransactions->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center text-secondary py-4">
                                    <i class="material-symbols-outlined fs-48 d-block mb-2">receipt_long_off</i>
                                    Nenhuma transação registrada
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Card de Resumo Geral -->
<div class="row">
    <div class="col-12">
        <div class="card bg-white p-20 rounded-10 border border-white">
            <h3 class="fs-18 mb-20">Resumo Geral do Sistema</h3>
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="border-end">
                        <h4 class="fs-32 fw-bold text-primary mb-1">{{ $stats['total_partners'] }}</h4>
                        <p class="mb-0 text-secondary">Parceiros Ativos</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-end">
                        <h4 class="fs-32 fw-bold text-info mb-1">{{ number_format($stats['total_customers'], 0, ',', '.') }}</h4>
                        <p class="mb-0 text-secondary">Clientes Cadastrados</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-end">
                        <h4 class="fs-32 fw-bold text-success mb-1">R$ {{ number_format($stats['total_balance'], 2, ',', '.') }}</h4>
                        <p class="mb-0 text-secondary">Saldo Total</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="fs-32 fw-bold text-warning mb-1">{{ number_format($stats['total_transactions'], 0, ',', '.') }}</h4>
                    <p class="mb-0 text-secondary">Transações Totais</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
