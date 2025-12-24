@extends('layouts.main')

@section('title', 'Gerenciar Parceiros')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
        <h3 class="mb-0">Gerenciar Parceiros</h3>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <span class="material-symbols-outlined me-2">add</span>
            Adicionar Parceiro
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
                    <th>Email</th>
                    <th>Documento</th>
                    <th>Clientes</th>
                    <th>Registros</th>
                    <th>Status</th>
                    <th>Criado em</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                <tr>
                    <td>#{{ $partner->id }}</td>
                    <td>{{ $partner->name }}</td>
                    <td>{{ $partner->email }}</td>
                    <td>{{ $partner->document }}</td>
                    <td>
                        <span class="badge bg-info">{{ $partner->end_customers_count }}</span>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $partner->value_records_count }}</span>
                    </td>
                    <td>
                        @if($partner->is_active)
                            <span class="badge bg-success">Ativo</span>
                        @else
                            <span class="badge bg-danger">Inativo</span>
                        @endif
                    </td>
                    <td>{{ $partner->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                <span class="material-symbols-outlined fs-18">edit</span>
                            </a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este parceiro?');">
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
                        <p class="mb-0 text-muted">Nenhum parceiro cadastrado.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($partners->hasPages())
    <div class="mt-4">
        {{ $partners->links() }}
    </div>
    @endif
</div>
@endsection
