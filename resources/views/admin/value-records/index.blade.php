@extends('layouts.main')

@section('title', 'Gerenciar Registros de Valores')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
        <h3 class="mb-0">Gerenciar Registros de Valores</h3>
        <a href="{{ route('admin.value-records.create') }}" class="btn btn-primary">
            <span class="material-symbols-outlined me-2">add</span>
            Adicionar Registro
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Filtros -->
    <div class="card bg-light p-3 mb-3">
        <form action="{{ route('admin.value-records.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <select class="form-select" name="partner_id" onchange="this.form.submit()">
                        <option value="">Todos os Parceiros</option>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}" {{ request('partner_id') == $partner->id ? 'selected' : '' }}>
                                {{ $partner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <select class="form-select" name="transaction_type" onchange="this.form.submit()">
                        <option value="">Todos os Tipos</option>
                        <option value="credit" {{ request('transaction_type') == 'credit' ? 'selected' : '' }}>Crédito</option>
                        <option value="debit" {{ request('transaction_type') == 'debit' ? 'selected' : '' }}>Débito</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="{{ route('admin.value-records.index') }}" class="btn btn-outline-secondary w-100">Limpar Filtros</a>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Parceiro</th>
                    <th>Cliente Final</th>
                    <th>Tipo</th>
                    <th>Valor Total</th>
                    <th>Parcelas</th>
                    <th>Valor/Parcela</th>
                    <th>Data</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($valueRecords as $record)
                <tr>
                    <td>#{{ $record->id }}</td>
                    <td>
                        <span class="badge bg-info">{{ $record->partner->name }}</span>
                    </td>
                    <td>{{ $record->endCustomer->name }}</td>
                    <td>
                        @if($record->transaction_type === 'credit')
                            <span class="badge bg-success">Crédito</span>
                        @else
                            <span class="badge bg-danger">Débito</span>
                        @endif
                    </td>
                    <td>R$ {{ number_format($record->total_amount, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $record->installments }}x</span>
                    </td>
                    <td>R$ {{ number_format($record->installment_amount, 2, ',', '.') }}</td>
                    <td>{{ $record->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.value-records.edit', $record) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                <span class="material-symbols-outlined fs-18">edit</span>
                            </a>
                            <form action="{{ route('admin.value-records.destroy', $record) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                    <span class="material-symbols-outlined fs-18">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <p class="mb-0 text-muted">Nenhum registro encontrado.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($valueRecords->hasPages())
    <div class="mt-4">
        {{ $valueRecords->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
