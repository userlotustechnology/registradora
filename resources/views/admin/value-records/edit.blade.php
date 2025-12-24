@extends('layouts.main')

@section('title', 'Editar Registro de Valor')

@section('content')
<div class="card bg-white p-20 rounded-10 border border-white mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-20">
        <h3 class="mb-0">Editar Registro de Valor</h3>
        <a href="{{ route('admin.value-records.index') }}" class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Voltar
        </a>
    </div>

    <form action="{{ route('admin.value-records.update', $valueRecord) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="partner_id" class="form-label">Parceiro <span class="text-danger">*</span></label>
                <select class="form-select @error('partner_id') is-invalid @enderror" 
                        id="partner_id" name="partner_id" required>
                    <option value="">Selecione um parceiro</option>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}" {{ old('partner_id', $valueRecord->partner_id) == $partner->id ? 'selected' : '' }}>
                            {{ $partner->name }}
                        </option>
                    @endforeach
                </select>
                @error('partner_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="end_customer_id" class="form-label">Cliente Final <span class="text-danger">*</span></label>
                <select class="form-select @error('end_customer_id') is-invalid @enderror" 
                        id="end_customer_id" name="end_customer_id" required>
                    <option value="">Selecione um cliente</option>
                    @foreach($endCustomers as $customer)
                        <option value="{{ $customer->id }}" data-partner="{{ $customer->partner_id }}" {{ old('end_customer_id', $valueRecord->end_customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->partner->name }})
                        </option>
                    @endforeach
                </select>
                @error('end_customer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="transaction_type" class="form-label">Tipo de Transação <span class="text-danger">*</span></label>
                <select class="form-select @error('transaction_type') is-invalid @enderror" 
                        id="transaction_type" name="transaction_type" required>
                    <option value="">Selecione</option>
                    <option value="credit" {{ old('transaction_type', $valueRecord->transaction_type) == 'credit' ? 'selected' : '' }}>Crédito</option>
                    <option value="debit" {{ old('transaction_type', $valueRecord->transaction_type) == 'debit' ? 'selected' : '' }}>Débito</option>
                </select>
                @error('transaction_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="total_amount" class="form-label">Valor Total <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="number" step="0.01" class="form-control @error('total_amount') is-invalid @enderror" 
                           id="total_amount" name="total_amount" value="{{ old('total_amount', $valueRecord->total_amount) }}" required>
                </div>
                @error('total_amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="installments" class="form-label">Número de Parcelas <span class="text-danger">*</span></label>
                <input type="number" min="1" class="form-control @error('installments') is-invalid @enderror" 
                       id="installments" name="installments" value="{{ old('installments', $valueRecord->installments) }}" required>
                @error('installments')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $valueRecord->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.value-records.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-outlined me-2">save</span>
                Atualizar Registro
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const partnerSelect = document.getElementById('partner_id');
    const customerSelect = document.getElementById('end_customer_id');
    
    partnerSelect.addEventListener('change', function() {
        const partnerId = this.value;
        const options = customerSelect.querySelectorAll('option[data-partner]');
        
        options.forEach(option => {
            if (partnerId === '' || option.dataset.partner === partnerId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
        
        // Reset customer selection if not matching
        const selectedOption = customerSelect.options[customerSelect.selectedIndex];
        if (selectedOption && selectedOption.dataset.partner && selectedOption.dataset.partner !== partnerId) {
            customerSelect.value = '';
        }
    });
});
</script>
@endsection
