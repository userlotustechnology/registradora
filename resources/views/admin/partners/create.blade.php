@extends('layouts.main')

@section('title', 'Adicionar Parceiro')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
        <h3 class="mb-0">Adicionar Novo Parceiro</h3>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Voltar
        </a>
    </div>

    <form action="{{ route('admin.partners.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nome do Parceiro <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="document" class="form-label">CPF/CNPJ <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('document') is-invalid @enderror" 
                       id="document" name="document" value="{{ old('document') }}" required>
                @error('document')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="is_active" class="form-label">Status</label>
                <select class="form-select @error('is_active') is-invalid @enderror" 
                        id="is_active" name="is_active">
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inativo</option>
                </select>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="alert alert-info" role="alert">
            <span class="material-symbols-outlined me-2">info</span>
            Um token de API será gerado automaticamente para este parceiro.
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-outlined me-2">save</span>
                Salvar Parceiro
            </button>
        </div>
    </form>
</div>
@endsection
