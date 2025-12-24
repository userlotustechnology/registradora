<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValueRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $transactionType = $this->input('transaction_type');
        
        $rules = [
            'end_customer_uuid' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:credit,debit',
            'installments' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'order_reference' => 'nullable|string|max:255',
        ];

        // Validação condicional do payment_type baseado no transaction_type
        if ($transactionType === 'credit') {
            $rules['payment_type'] = ['required', Rule::in(['pix', 'boleto', 'cartao_credito', 'outro'])];
        } elseif ($transactionType === 'debit') {
            $rules['payment_type'] = ['required', Rule::in(['estorno_total', 'estorno_parcial', 'chargeback', 'taxa'])];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'payment_type.required' => 'O tipo de pagamento é obrigatório.',
            'payment_type.in' => 'O tipo de pagamento selecionado é inválido para este tipo de transação.',
            'transaction_type.in' => 'O tipo de transação deve ser credit ou debit.',
