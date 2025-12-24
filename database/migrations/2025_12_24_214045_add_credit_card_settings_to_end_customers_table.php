<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('end_customers', function (Blueprint $table) {
            $table->enum('credit_card_receipt_type', ['d_plus', 'installment_flow'])->default('d_plus')->after('credit_balance')
                ->comment('Tipo de recebimento: d_plus (D+X dias) ou installment_flow (mês a mês por parcela)');
            $table->integer('credit_card_days')->default(30)->after('credit_card_receipt_type')
                ->comment('Quantidade de dias para recebimento (usado em d_plus)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('end_customers', function (Blueprint $table) {
            $table->dropColumn(['credit_card_receipt_type', 'credit_card_days']);
        });
    }
};
