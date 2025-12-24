<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EndCustomer;
use App\Models\ValueRecord;

class RecalculateCustomerBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:recalculate-balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalcula os saldos de todos os clientes baseado em seus registros de valores';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando recálculo de saldos...');

        $customers = EndCustomer::all();
        $bar = $this->output->createProgressBar(count($customers));
        $bar->start();

        foreach ($customers as $customer) {
            $availableBalance = 0;
            $creditBalance = 0;

            $records = ValueRecord::where('end_customer_id', $customer->id)->get();

            foreach ($records as $record) {
                if ($record->transaction_type === 'credit') {
                    if (in_array($record->payment_type, ['pix', 'boleto', 'outro'])) {
                        $availableBalance += $record->total_amount;
                    } elseif ($record->payment_type === 'cartao_credito') {
                        $creditBalance += $record->total_amount;
                    }
                } elseif ($record->transaction_type === 'debit') {
                    $availableBalance -= $record->total_amount;
                }
            }

            $customer->update([
                'available_balance' => $availableBalance,
                'credit_balance' => $creditBalance,
            ]);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Saldos recalculados com sucesso!');
        $this->info("Total de clientes processados: " . count($customers));

        return Command::SUCCESS;
    }
}