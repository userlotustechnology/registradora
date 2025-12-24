@extends('layouts.main')

@section('title', 'Editar Cliente Final')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
        <h3 class="mb-0">Editar Cliente Final</h3>
        <a href="{{ route('admin.end-customers.index') }}" class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Voltar
        </a>
    </div>

    <form action="{{ route('admin.end-customers.update', $endCustomer) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nome do Cliente <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $endCustomer->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="document" class="form-label">CPF/CNPJ <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('document') is-invalid @enderror" 
                       id="document" name="document" value="{{ old('document', $endCustomer->document) }}" required>
                @error('document')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="partner_id" class="form-label">Parceiro <span class="text-danger">*</span></label>
                <select class="form-select @error('partner_id') is-invalid @enderror" 
                        id="partner_id" name="partner_id" required>
                    <option value="">Selecione um parceiro</option>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}" {{ old('partner_id', $endCustomer->partner_id) == $partner->id ? 'selected' : '' }}>
                            {{ $partner->name }} - {{ $partner->email }}
                        </option>
                    @endforeach
                </select>
                @error('partner_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.end-customers.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-outlined me-2">save</span>
                Atualizar Cliente
            </button>
        </div>
    </form>
</div>
@endsection
