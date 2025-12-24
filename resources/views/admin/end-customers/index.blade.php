@extends('layouts.main')

@section('title', 'Gerenciar Clientes Finais')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
        <h3 class="mb-0">Gerenciar Clientes Finais</h3>
        <a href="{{ route('admin.end-customers.create') }}" class="btn btn-primary">
            <span class="material-symbols-outlined me-2">add</span>
            Adicionar Cliente
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Parceiro</th>
                    <th>Criado em</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($endCustomers as $customer)
                <tr>
                    <td>#{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->document }}</td>
                    <td>
                        <span class="badge bg-info">{{ $customer->partner->name }}</span>
                    </td>
                    <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.end-customers.edit', $customer) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                <span class="material-symbols-outlined fs-18">edit</span>
                            </a>
                            <form action="{{ route('admin.end-customers.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
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
                    <td colspan="6" class="text-center py-4">
                        <p class="mb-0 text-muted">Nenhum cliente cadastrado.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($endCustomers->hasPages())
    <div class="mt-4">
        {{ $endCustomers->links() }}
    </div>
    @endif
</div>
@endsection
