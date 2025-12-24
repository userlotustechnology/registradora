<?php

namespace App\Observers;

use App\Models\ValueRecord;
use App\Models\CreditCardRelease;

class ValueRecordObserver
{
    /**
     * Handle the ValueRecord "created" event.
     */
    public function created(ValueRecord $valueRecord): void
    {
        $this->updateCustomerBalance($valueRecord);
    }

    /**
     * Handle the ValueRecord "updated" event.
     */
    public function updated(ValueRecord $valueRecord): void
    {
        // Se o registro foi atualizado, recalcula o saldo do cliente
        $this->recalculateCustomerBalance($valueRecord->end_customer_id);
    }

    /**
     * Handle the ValueRecord "deleted" event.
     */
    public function deleted(ValueRecord $valueRecord): void
    {
        // Quando deletado (soft delete), recalcula o saldo
        $this->recalculateCustomerBalance($valueRecord->end_customer_id);
    }

    /**
     * Handle the ValueRecord "restored" event.
     */
    public function restored(ValueRecord $valueRecord): void
    {
        // Quando restaurado, recalcula o saldo
        $this->recalculateCustomerBalance($valueRecord->end_customer_id);
    }

    /**
     * Handle the ValueRecord "force deleted" event.
     */
    public function forceDeleted(ValueRecord $valueRecord): void
    {
        $this->recalculateCustomerBalance($valueRecord->end_customer_id);
    }

    /**
     * Atualiza o saldo do cliente baseado no registro de valor criado
     */
    private function updateCustomerBalance(ValueRecord $valueRecord): void
    {
        $customer = $valueRecord->endCustomer;
        if (!$customer) return;

        $amount = $valueRecord->total_amount;

        if ($valueRecord->transaction_type === 'credit') {
            // Para créditos, verifica o tipo de pagamento
            if (in_array($valueRecord->payment_type, ['pix', 'boleto'])) {
                // PIX e Boleto vão para saldo disponível
                $customer->increment('available_balance', $amount);
            } elseif ($valueRecord->payment_type === 'cartao_credito') {
                // Cartão de crédito vai para saldo de crédito
                $customer->increment('credit_balance', $amount);
                
                // Cria os registros de liberação agendada
                $this->createCreditCardReleases($valueRecord, $customer);
            } else {
                // Outros tipos vão para saldo disponível
                $customer->increment('available_balance', $amount);
            }
        } elseif ($valueRecord->transaction_type === 'debit') {
            // Para débitos, desconta do saldo disponível
            $customer->decrement('available_balance', $amount);
        }
    }

    /**
     * Recalcula completamente o saldo do cliente
     */
    private function recalculateCustomerBalance(int $customerId): void
    {
        $customer = \App\Models\EndCustomer::find($customerId);
        if (!$customer) return;

        // Zera os saldos
        $availableBalance = 0;
        $creditBalance = 0;

        // Busca todos os registros do cliente
        $records = ValueRecord::where('end_customer_id', $customerId)->get();

        foreach ($records as $record) {
            if ($record->transaction_type === 'credit') {
                if (in_array($record->payment_type, ['pix', 'boleto'])) {
                    $availableBalance += $record->total_amount;
                } elseif ($record->payment_type === 'cartao_credito') {
                    $creditBalance += $record->total_amount;
                } else {
                    $availableBalance += $record->total_amount;
                }
            } elseif ($record->transaction_type === 'debit') {
                $availableBalance -= $record->total_amount;
            }
        }

        // Atualiza o cliente
        $customer->update([
            'available_balance' => $availableBalance,
            'credit_balance' => $creditBalance,
        ]);
    }

    /**
     * Cria os registros de liberação agendada para pagamentos com cartão de crédito
     */
    private function createCreditCardReleases(ValueRecord $valueRecord, $customer): void
    {
        // Se não tiver configuração ou se não tiver parcelas, não faz nada
        if (!$valueRecord->installments || $valueRecord->installments <= 0) {
            return;
        }

        $receiptType = $customer->credit_card_receipt_type ?? 'd_plus';
        $days = $customer->credit_card_days ?? 30;

        if ($receiptType === 'd_plus') {
            // D+X: Uma única liberação após X dias
            CreditCardRelease::create([
                'value_record_id' => $valueRecord->id,
                'end_customer_id' => $customer->id,
                'amount' => $valueRecord->total_amount,
                'installment_number' => null,
                'scheduled_date' => now()->addDays($days),
                'processed' => false,
            ]);
        } elseif ($receiptType === 'installment_flow') {
            // Fluxo de parcelas: Uma liberação por mês para cada parcela
            $installmentAmount = $valueRecord->total_amount / $valueRecord->installments;
            
            for ($i = 1; $i <= $valueRecord->installments; $i++) {
                CreditCardRelease::create([
                    'value_record_id' => $valueRecord->id,
                    'end_customer_id' => $customer->id,
                    'amount' => $installmentAmount,
                    'installment_number' => $i,
                    'scheduled_date' => now()->addMonths($i),
                    'processed' => false,
                ]);
            }
        }
    }
}
